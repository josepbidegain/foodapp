<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $restaurants = \App\Restaurant::where('active',true)->latest()->get();
        $last_orders = \App\Order::where('user_id',\Auth::user()->id);
        return view('client.home',compact('restaurants','last_orders'));
    }

    public function show($id)
    {
        if( \Auth::user()->id == $id){
            $user = \App\User::find($id);

            return view('client.show', compact('user'));  
        }

        return redirect('/');
    }

    public function updateClient(Request $request){

        $id = $request->id;
        
        if ( \Auth::user()->id == $id ){
        
            $user = \App\User::find($id);
            $user->update($request->has('password') ? $request->all() : $request->except(['password']));

            //\App\Flash::message('Your account has been updated!');
            return redirect('/');
        }
    }


    private function isCartInitialized($rid){
        $this->client = new \Predis\Client();
        //$this->session_master = \Config::get('constants.cart_initialized');
        $this->session_master = "restaurant_".$rid;

        return $this->client->get($this->session_master) !== null;        
    }

    private function getProductsFromSession($restaurant_id){
        
        //$active_cart = $this->isCartInitialized($restaurant_id);
        $products_cart = array();
        
        if ( session( $restaurant_id . "-products") ){
            $prods_id_cart = json_decode( $restaurant_id . "-products");

            $products_cart = \App\Product::where('id', $prods_id_cart )->get();
            
        }

        return $products_cart;
    }

    public function checkDiscount($restaurant,$session_prods,$products =null,$products_cart){

        $have_discount = $restaurant->getActiveDiscount();
        //$have_discount = \App\Discount::where('restaurant_id', $id)->where('start_date' '<', $now)->where('end_date', '>=', $now);
        $percent = 0;
        foreach($have_discount as $d){
           $percent = $d->percent; 
        }
        
        if ( $products != null && $percent != 0 ){            
            foreach ($products as $p) {            
                $p->afterDiscount = ceil ( $p->price - ( ($p->price * $percent) / 100 ) );
            }
        }
        
        $subTotal=0;
        foreach ( $products_cart as $p ){
            $p->count = $session_prods[$p->id];

            $p->afterDiscount = 0;
            if ( $percent != 0 ){
                $p->afterDiscount = ceil( $p->price - ( ($p->price * $percent) / 100 ) );
                $p->totalPrice = $session_prods[$p->id] * $p->afterDiscount;
            }else{
                $p->totalPrice = $session_prods[$p->id] * $p->price;
            }

            $subTotal += $p->totalPrice;
            /*
            $discount = \App\Promotion::where('restaurant_id',$id)->where('product_id',$p->id);
            $p->discount = $discount;*/
        }
        return array($have_discount,$products_cart,$products,$subTotal);
    }

    public function showRestaurant($id,$name){
        
        $products_cart = array();
        if ( $session_prods = \Session::get("restaurant-".$id) ){
            $products_cart = \App\Product::whereIn("id",array_keys($session_prods))->get(); 
        }
        
        $restaurant = \App\Restaurant::find($id);        
        $products = \App\Product::where('restaurant_id',$id)->get();

        $arrayInfo = $this->checkDiscount($restaurant,$session_prods,$products,$products_cart);
        $have_discount = $arrayInfo[0];
        $products_cart = $arrayInfo[1];
        $products = $arrayInfo[2];
        $subTotal = $arrayInfo[3];

        $mainAddress = \Auth::user()->address; 
        $otherAddress= \App\Address::where('user_id', \Auth::user()->id)->get();
        
        $recomendated_products = array();//\App\Product::where('restaurant_id',$id)->where('active',true)->where('recomendated',true)->get();
        if ($have_discount){
            foreach ($products as $p){
                if ($p->recomendated == 1){
                    $recomendated_products []= $p;    
                }                
            }
        }else{
            
            $recomendated_products = \App\Product::where('restaurant_id',$id)->where('active',true)->where('recomendated',true)->get();            
        }

        $has_complete_data_user = ($mainAddress != null && \Auth::user()->phone != null);

        return view('client.showRestaurant',compact('restaurant','products','products_cart', 'mainAddress', 'otherAddress', 'subTotal', 'have_discount','recomendated_products','has_complete_data_user'));
    }


    

    public function showOrders(){
        return view('client.myOrders');
    }

    public function showFavorites(){
        return view('client.myFavorites');
    }

    public function add_product_to_cart(Request $request){
        
        if ($request->ajax()){

            $restaurant_id = $request->restaurant_id;
            $prod  = $request->product_id;
            $count = $request->number;
            
            $array_prods = array();
            
            if ( ! $session_prods = \Session::get("restaurant-".$restaurant_id) ){
                \Session::put("restaurant-".$restaurant_id, $array_prods);
                $session_prods = array();
            }
            
            if ( array_key_exists($prod, $session_prods) ){
                $session_prods[$prod] += $count;
            }else{
                $session_prods[$prod] = $count;
            }

            \Session::put("restaurant-".$restaurant_id, $session_prods);
            
            $products_cart = \App\Product::whereIn("id",array_keys($session_prods))->get();


            $restaurant = \App\Restaurant::find($restaurant_id);

            $arrayInfo = $this->checkDiscount($restaurant,$session_prods,null,$products_cart);
            
            $products_cart = $arrayInfo[1];
            //$products = $arrayInfo[2];
            $subTotal = $arrayInfo[3];

            /*
            $subTotal = 0;

            foreach ( $products_cart as $prod ){
                $subTotal += ( $prod->price * $session_prods[$prod->id]);    
            }
            */
            $mainAddress = \Auth::user()->address; 
            $otherAddress= \App\Address::where('user_id', \Auth::user()->id)->get();

            return json_encode( array("data"=>$session_prods,"products"=>$products_cart, "subTotal"=>$subTotal, "mainAddress"=>$mainAddress, "otherAddress"=>$otherAddress ) );    
        }

        return redirect('/');
        
    }

    public function remove_product_from_cart(Request $request){
        
        if ($request->ajax()){

            $product_id = $request->prod_id;
            $restaurant_id = $request->restaurant_id;

            if ( ! $session_prods = \Session::get("restaurant-".$restaurant_id) ){
                return json_encode(array("error"=>true,"message"=>"Session expired"));
            }

            if ( $product_id != null ){
                if ( array_key_exists($product_id, $session_prods) ){
                    unset($session_prods[$product_id]);
                }    
            }else{ //delete session with Remove ALL
                unset($session_prods);
                $session_prods = array();
            }
            

            \Session::put("restaurant-".$restaurant_id, $session_prods);
            
            $products_cart = \App\Product::whereIn("id",array_keys($session_prods))->get(); 
            
            $subTotal = 0;

            foreach ( $products_cart as $prod ){
                $subTotal += ( $prod->price * $session_prods[$prod->id]);    
            }
            
            $mainAddress = \Auth::user()->address; 
            $otherAddress= \App\Address::where('user_id', \Auth::user()->id)->get();

            return json_encode( array("data"=>$session_prods,"products"=>$products_cart, "subTotal"=>$subTotal, "mainAddress"=>$mainAddress, "otherAddress"=>$otherAddress ) );
            
        }

        return redirect('/');
    }

    public function manage_product_from_cart(Request $request){
        
        if ($request->ajax()){

            $restaurant_id = (int)$request->restaurant_id;
            $product_id = (int)$request->product_id;
            $count = (int)$request->number;  

            if ( ! $session_prods = \Session::get("restaurant-".$restaurant_id) ){
                return json_encode(array("error"=>true,"message"=>"Session expired"));
            }

            if ( $product_id != null && $count != null){
                if ( array_key_exists($product_id, $session_prods) ){
                    $session_prods[$product_id] = $count;
                }    
            }else{
                return json_encode(array("error"=>true,"message"=>"Bad parameters"));
            }
            

            \Session::put("restaurant-".$restaurant_id, $session_prods);
            
            $products_cart = \App\Product::whereIn("id",array_keys($session_prods))->get(); 
            
            $subTotal = 0;

            foreach ( $products_cart as $prod ){
                $subTotal += ( $prod->price * $session_prods[$prod->id]);    
            }
            
            $mainAddress = \Auth::user()->address; 
            $otherAddress= \App\Address::where('user_id', \Auth::user()->id)->get();

            return json_encode( array("data"=>$session_prods,"products"=>$products_cart, "subTotal"=>$subTotal, "mainAddress"=>$mainAddress, "otherAddress"=>$otherAddress ) );

        }

        return redirect('/');
    }

    public function hola(){
        \Event::fire(new \App\Events\Event(\Auth::user()));
        /*$job = (new \App\Jobs\SendReminderEmail(\Auth::user()))                
                 ->delay(\Carbon\Carbon::now()->addMinutes(2));
    
        dispatch($job);
        */
        return "Gracias por pedir tu cena con nosotros, sumaste 1 mordisco";
    }


}
