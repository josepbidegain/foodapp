<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function show($id)
    {

        if( \Auth::user()->id == $id){
            $user = \App\User::find($id);

            return view('admin.profile.show', compact('user'));  
        }

        return redirect('/');

    }

#########################################################
# CLIENTS
#########################################################

    public function clients(){
        
        $users = \App\User::where('type', 'client')->latest()->get();
        
        return view('admin.client.index', compact('users'));
    }

    public function createClient(){
        
        return view('admin.client.create');
    }


    protected function validator(array $data, $type)
    {
        switch ($type) {
            case 'client':
                
                return \Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',            
                    'password' => 'required|string|min:6|confirmed',
                    //'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                ]);
                
                break;

            case 'product':
                
                return \Validator::make($data, [
                    'restaurant_id' => 'required|integer',
                    'category_id' => 'required|integer',
                    'description' => 'required|string',            
                    'price' => 'required|integer'                    
                ]);
                
                break;

            case 'restaurant':
                
                return \Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'phone' => 'required|integer|max:9',
                    'address' => 'required|string|max:255',
                    'city' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',            
                    'password' => 'required|string|min:6|confirmed',
                    'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
                ]);
                break;

            case 'category':
                return \Validator::make($data, [
                    'name' => 'required|string|unique_with:categories,restaurant_id|max:255',
                ]);
                break;

            case 'discount':
                return \Validator::make($data, [
                
                    'restaurant_id' => 'required|integer',
                    'name' => 'required|string|unique_with:discounts,restaurant_id|max:255',
                    'percent' => 'required|integer',
                    'start_date' => 'required|date',
                    'end_date' => 'date',
                    'range_limit' => 'boolean',
                    'min_value' => 'integer',
                    'max_value' => 'integer',
                    'active' => 'boolean',
            

                    ]);
                break;

            case 'promotion':
                return \Validator::make($data, [
                
                    'restaurant_id' => 'required|integer',
                    'name' => 'required|string|max:255',
                    'description' => 'required|string|max:255',
                    'price' => 'required|integer',
                    'start_date' => 'required|date',
                    'end_date' => 'date',                    
                    'active' => 'boolean',            

                    ]);
                break;
            default:
                # code...
                break;
        }
        
    }

    public function insertClient(Request $request){
        /*$token = $request->ajax() ? $request->header('X-CSRF-TOKEN') : $request['_token'];
        \Log::info("-->token ".$token);
        if (\Session::token() != $token)
            throw new \Illuminate\Session\TokenMismatchException;

        */
        if ( $request->ajax() && $this->validator( $request->all(), 'client' ) ){

            User::create([
                "name" => ucwords($request['name']),
                "lastname" => ucwords($request['lastname']),
                "email" => $request['email'],
                "phone" => $request['phone'],
                "address" => ucwords($request['address']),
                "password" => bcrypt($request['password']),
                "type" => 'client',
                "active" => 1

            ]);

        }
        $clients = User::where('type','client')->latest()->get();
        $table = view('admin.client.clients-ajax',compact('clients'))->render();
        return (json_encode( array('status'=>200, 'message'=>'user created', 'data'=>$table) ));

    }

    public function editClient($id){
        //Client::find($id)->get();
        return view('admin.editclient');
    }

    public function updateClient(Request $request){
        /*
        $this->validate([
            $request->title => 'min:3',
            $request->body => 'string',
            ]);

        $client = Client::find($request->id);
        */
        return view('admin.editClient')->with('message','ok');

    }

    public function deactivateClient(Request $request){
        return view('admin.showClients');
    }

    public function findClient(Request $request){
        /*
        $users = User::where('name',$request->name);

        return json_encode($users);
        */
    }

#########################################################
# END CLIENTS
#########################################################


#########################################################
# PROVIDERS
#########################################################

    public function restaurants(){
        $restaurants = \App\Restaurant::all();
        return view('admin.restaurant.showRestaurants',compact('restaurants'));
    }
    
    public function insertRestaurant(Request $request){
        
        if ( $request->ajax() && $this->validator($request->all(), 'restaurant') ){
            
            if( $request->hasFile('logo')){ 
                
                $slug =  str_slug( strtolower($request['name'])." ". strtolower($request['lastname']));

                $image = $request->file('logo');
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/');
                $image->move($destinationPath.$slug."/", $input['imagename']);

                \DB::beginTransaction();

                $user = User::create([
                        "name" => ucwords($request['name']),                    
                        "lastname" => ucwords($request['lastname']),
                        "email" => $request['email'],
                        "password" => bcrypt($request['password']),
                        "phone" => $request['phone'],
                        "address" => $request['address'],                    
                        //"city" => $request['city'],                    
                        //"zip" => $request['zip'],                    
                        "type" => 'restaurant',
                        //'logo' => $slug."/".$input['imagename'],
                        "active" => 1
                    ]);

                try{
                    \App\Restaurant::create([
                        "user_id" => $user->id,
                        "category_id" => $request['category'],
                        "name" => ucwords($request['name']),                    
                        "slug" => $slug ,                    
                        "phone" => $request['phone'],
                        "address" => $request['address'],
                        "open_hour" => $request['open_hour'],
                        "close_hour" => $request['close_hour'],
                        "city" => ucwords($request['city']),
                        "zip" => $request['zip'],                    
                        'logo' => $slug."/".$input['imagename'],
                        "active" => 1
                    ]);    
                }catch (Exception $e){
                    \DB::rollBack();
                }

                \DB::commit();

                $restaurants = \App\Restaurant::all();
                $table = view('admin.restaurant.restaurants-ajax',compact('restaurants'))->render();
                
                return json_encode( array('status'=>200, 'message'=>'restaurant created', 'data'=>$table) );

            }

            return json_encode(array('status'=>400, 'message'=>'Dont receive logo'));
        }

        return json_encode(array('status'=>400, 'message'=>'Request doesnt is ajax or not passed validate'));
        
    }

    public function editRestaurant($id){
        $restaurant = \App\Restaurant::find($id);
        $user = $restaurant->user();
        
        return view('admin.restaurant.edit',compact('restaurant'));
    }

    public function updateRestaurant(Request $request){
        /*
        $this->validate([
            $request->title => 'min:3',
            $request->body => 'string',
            ]);

        $client = Client::find($request->id);
        */
        return view('admin.editRestaurant')->with('message','ok');

    }

    public function deactivateRestaurant(Request $request){
        return view('admin.showRestaurants');
    }

    public function findRestaurant(Request $request){
        /*
        $users = User::where('name',$request->name);

        return json_encode($users);
        */
    }

#########################################################
# END PROVIDERS
#########################################################

#########################################################
# PRODUCTS
#########################################################

public function products(){
    $products = \App\Product::all();
    $restaurants = \App\Restaurant::where('active',1)->latest()->get();

    return view('admin.product.showProducts', compact('products','restaurants'));
}

public function getCategoriesByRestaurant(Request $request){
    
    if ( $request->ajax() ){
        $categories = \App\Category::where('restaurant_id',$request['restaurant_id'])->get();
        return json_encode($categories);
    }

    return redirect('/');
    
}

public function insertProduct(Request $request){

    if ( $request->ajax() ){//&& $this->validator($request->all()) ){
        
        \Log::info($request->all());
        \Log::info($request->hasFile('logo'));

        $restaurant = \App\Restaurant::find($request['restaurant']);

        if( $request->hasFile('logo')){ 
            
            $slug =  str_slug( strtolower($request['title']));

            $image = $request->file('logo');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/products/');
            $image->move($destinationPath.'/'.$restaurant->slug.'/'.$slug."/", $input['imagename']);
        }

        $result = \App\Product::create([
                "restaurant_id" => $request['restaurant'],
                "category_id" => $request['category'],
                "title" => $request['title'],
                "description" => $request['description'],
                "image" => isset($slug) ? ($slug."/".$input['imagename']):null,
                "recomendated" => $request['recomendated'] != null  ? $request['recomendated']:false,
                "price" => $request['price'],
                "active" => 1

            ]);
        \Log::info('result insert product '.$result);
        \Log::info('taste_name '.$request['taste_name']);
        if ($result && $request['taste_name'] != null){
            
            $tastes = explode(",", $request['taste_name']);
            foreach ( $tastes as $taste){
                $oTaste = new \App\FoodTaste();
                $oTaste->product_id = $result->id;
                $oTaste->name = ucwords($taste);
                $oTaste->slug = str_slug(strtolower($taste));
                $oTaste->active = 1;
                $oTaste->save();                
            }
        }

        $products = \App\Product::all();
        $table = view('admin.product.products-ajax',compact('products'))->render();
        return json_encode( array('status'=>200, 'message'=>'product created', 'data'=>$table) );        

    }
    
    return redirect('/');    
    
}
#########################################################
# END PRODUCTS
#########################################################


#########################################################
# CATEGORY
#########################################################
public function insertCategory(Request $request){
    if ( $request->ajax() && $this->validator($request->all(),"category") ){
        
        $categories = explode(",", $request['name']);
        foreach ( $categories as $cat){

            \App\Category::create([
                'restaurant_id' => $request['restaurant_id'],
                'name' => $cat,
                'slug' => str_slug($cat),
                'active' => 1,
            ]);
        }
        
        if ( count($categories) == 1){
            $message = "Category Created Succesfully";
        }else if (count($categories) > 1 ){
            $message = "Categories Created Succesfully";
        } 

        return json_encode(array("status"=>200,"message"=>$message));
        $categories = \App\Category::all();
        $table = view('admin.category.categories-ajax',compact('categories'))->render();
    }

    return redirect('/');
}

#########################################################
# END CATEGORIES
#########################################################


#########################################################
# DISCOUNTS
#########################################################

public function showDiscounts(){
    $discounts = \App\Discount::all();   
    $restaurants = \App\Restaurant::where('active',1)->latest()->get();

    return view('admin.discount.showDiscounts', compact('discounts','restaurants'));   
}

public function editDiscount($id){

    $discount = \App\Discount::find($id);
    $restaurant = \App\Restaurant::find($discount->restaurant_id);

    
    return view('admin.discount.edit',compact('discount','restaurant'));
}

public function insertDiscount(Request $request){
    if ($request->ajax() && $this->validator($request->all(),"discount")){

        \App\Discount::create([
            'restaurant_id' => $request['restaurant_id'],
            'name' => $request['name'],
            'percent' => $request['percent'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
            'range_limit' => ($request['range_limit'] != null) ? $request['range_limit'] : false,
            'min_value' => ($request['min_value'] != null) ? $request['min_value'] : 0,
            'max_value' => ($request['max_value'] != null) ? $request['max_value'] : 0,
            'active' => 1,
        ]);
        
        $discounts = \App\Discount::all();
        $table = view('admin.discount.discounts-ajax',compact('discounts'))->render();
        
        return json_encode(array("status"=>200,"message"=>"Discount Created Succesfully", "data"=>$table));
        
           
    }
    return redirect('/');
}

public function updateDiscount(Request $request){
    if ($request->ajax() && $this->validator($request->all(),"discount")){
        
        $discount = \App\Discount::find( $request->input('discount_id') );
        $discount->update($request->all());

        return json_encode(array("status"=>200, "message"=>"Discount updated correctly"));

    }
    return json_encode(array("status"=>400, "message"=>"Request isn't a valid ajax"));
}

#########################################################
# END DISCOUNTS
#########################################################

#########################################################
# PROMOTIONS
#########################################################

public function promotions(){
    $promotions = \App\Promotion::all();
    $restaurants = \App\Restaurant::all();
    return view('admin.promotion.showPromotions', compact('promotions', 'restaurants'));
}

public function editPromotion(\App\Promotion $promotion){
    $restaurant = $promotion->restaurant;
    //dd($restaurant);
    return view('admin.promotion.edit', compact('promotion','restaurant'));
}

public function updatePromotion(Request $request){
    if ($request->ajax() && $this->validator($request->all(),"promotion")){
        
        $promotion = \App\Promotion::find( $request->input('promotion_id') );
        $promotion->update($request->all());

        return json_encode(array("status"=>200, "message"=>"Promotion updated succesfully"));

    }
    return json_encode(array("status"=>400, "message"=>"Request isn't a valid ajax"));
}
#########################################################
# END PROMOTIONS
#########################################################


#########################################################
# ORDERS
#########################################################

public function orders(){
    $orders = \App\Order::all();   

    return view('admin.showOrders', compact('orders'));
}

#########################################################
# END ORDERS
#########################################################

}
