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

                \App\Restaurant::create([
                    "user_id" => $user->id,
                    "category_id" => $request['category'],
                    "name" => ucwords($request['name']),                    
                    "slug" => $slug ,                    
                    "phone" => $request['phone'],
                    "address" => $request['address'],
                    "city" => ucwords($request['city']),
                    "zip" => $request['zip'],                    
                    'logo' => $slug."/".$input['imagename'],
                    "active" => 1
                ]);

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

        $result = \App\Product::create([
                "restaurant_id" => $request['restaurant'],
                "category_id" => $request['category'],
                "title" => $request['title'],
                "description" => $request['description'],
                "price" => $request['price'],
                "active" => 1

            ]);

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
    if ( $request->ajax() ){
        
        \App\Category::create([
            'restaurant_id' => $request['restaurant_id'],
            'name' => $request['name'],
            'slug' => str_slug($request['name']),
            'active' => 1,
        ]);

        return json_encode(array("status"=>200,"message"=>"category created"));
        $categories = \App\Category::all();
        $table = view('admin.category.categories-ajax',compact('categories'))->render();
    }

    return redirect('/');
}

#########################################################
# END CATEGORIES
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
