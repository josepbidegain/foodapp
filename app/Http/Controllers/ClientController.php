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

    public function showRestaurant($id,$name){
        
        if ( !session(\Auth::user()->id . "-cart") )
            session(\Auth::user()->id . "-cart" , true);

        //\Config::set('constants.cart_initialized', \Auth::user()->id . "-cart" );
        $restaurant = \App\Restaurant::find($id);        
        $products = \App\Product::where('restaurant_id',$id)->get();

        $products_cart = $this->getProductsFromSession($id);

        return view('client.showRestaurant',compact('restaurant','products','products_cart'));
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

            if ( !$this->isCartInitialized($restaurant_id) ){
                $this->client->set($this->session_master, true);    
            }

            $prod = $request->product_id;
            $count = $request->number;
            $total = $count;

            $connection = new \Predis\Client();
            //$array_prods = json_decode( $this->client->get( $this->session_master.":products") );
            $array_prods = json_decode( session($restaurant_id . "-products") );
            
            if ($array_prods && in_array($prod, array_keys($array_prods)) ){
                $total = $array_prods[$prod] + count;
            }

            $array_prods[$prod] = $total;

        
            session( $restaurant_id . "-products",   
                                json_encode(array(
                                    $array_prods
                                    )
                                )
                            );
            //\Log::info($connection->get( $this->session_master.':products') );
            return json_encode( array("data"=>$array_prods) );    
        }

        return redirect('/');
        
    }

    public function remove_product_from_cart(Request $request){
        
        if ( $this->isCartInitialized() ){
            $this->client->del($this->session_master);            
        }

        $prod = $request->product_id;
        $count = $request->number;        

        if ( $this->client->get($prod) !== null ){

            $this->client->del($prod);
            $total = $client->get($prod) - $count;

        }

        $this->client->set($prod, $total);
        
        return json_encode( array("product"=>$prod, "count"=>$total) );
    }

    public function manage_product_from_cart(Request $request){
        $prod = $request->product_id;
        $count = $request->number;        
            
        if ( $this->isCartInitialized() ){
            $this->client->set($prod, $count);            
        }

        return json_encode( array("product"=>$prod, "count"=>$count) );
    }

}
