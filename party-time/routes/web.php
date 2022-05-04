<?php

use App\Models\Answer;
use App\Models\Cart;
use App\Models\GUsers;
use App\Models\Order;
use App\Models\Product;
use App\Models\Query;
use App\Models\Reviews;
use App\Models\Staff;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (session('user')) {
        $user = session('user');
        $products = Product::all();
        $cart_item = Cart::where(['user_id' => $user->id])->get();

        return Inertia::render('GUsers/GUsersHome', ['user' => $user, 'products' => $products, 'items_in_cart' => count($cart_item)]);
    } else {
        return Inertia::render('GUsers/GuestUserHome',['isLoggedIn' => false] );
    }
})->name('gusers.lending_page');

Route::get('/home', function () {

    if (session('user')) {
        $user = session('user');
        $products = Product::all();
        $cart_item = Cart::where(['user_id' => $user->id])->get();

        return Inertia::render('GUsers/GUsersHome', ['user' => $user, 'products' => $products, 'items_in_cart' => count($cart_item)]);
    } else {
        return Inertia::render('GUsers/GUsersLogin');
    }
    
    
})->name('gusers.home');


Route::get('/login', function () {
    if (session('user')) {
        $user = session('user');
        return Inertia::render('GUsers/GUsersHome', ['user' => $user]);
    } else {
        return Inertia::render('GUsers/GUsersLogin');
    }
})->name('gusers.login');


Route::get('/register', function () {
    if (session('user')) {
        $user = session('user');
        return Inertia::render('GUsers/GUsersHome', ['user' => $user]);
    } else {
        return Inertia::render('GUsers/GUsersRegister');
    }
})->name('gusers.register');

Route::get('/logout', function () {
    session(['user' => null]);
    return Inertia::render('GUsers/GUsersLogin');
})->name('guser.logout');

Route::get('/aboutus', function () {
    $user = session('user');
    return Inertia::render('AboutUs', ['user' => $user]);

})->name('guser.aboutus');

Route::get('/contactus', function () {
    $user = session('user');
    return Inertia::render('ContactUs', ['user' => $user]);

})->name('guser.contactus');


Route::post('/register', function (Request $request) {
    $id = new GUsers();

    $id->full_name = $request->full_name;
    $id->email = $request->email;
    $id->phone = $request->phone;
    $id->shipping_address = $request->shipping_address;
    $id->billing_address = $request->billing_address;
    $id->password = Hash::make($request->password);
    $id->save();

    session(['user' => $id]);

    return response(json_encode("Successfully Added User"));
})->name('superadmin.gusers.register');

Route::post('/login', function (Request $request) {

    $user = GUsers::where('email', $request->email)->get();

    if (count($user) > 0) {
        if (Hash::check($request->password, $user[0]->password)) {
            if ($user[0]->active == 0) {
                return response(-1);
            } else {
                session(['user' => $user[0]]);
                return response(1);
            }
        } else {
            return response(2);
        }
    } else {
        return response(0);
    }
})->name('superadmin.gusers.login');


//Products
Route::get('/gusers/product_details/{id}', function (Product $id, Request $request) {

    $user = session('user');
    $cart_item = Cart::where(['user_id' => $user->id])->get();
    $reviews = Reviews::where(['product_id' => $id->id])->get();

    return Inertia::render('GUsers/GUsersProductDetail', ['product' => $id, 'user' => $user, 'items_in_cart' => count($cart_item), 'reviews' => $reviews]);
})->name('gusers.product.detials');

Route::get('/gusers/cart', function (Request $request) {
    $user = session('user');
    $total = 0;
    $cart_item = Cart::where(['user_id' => $user->id])->get();
    foreach ($cart_item as $key => $value) {
        $product = Product::find($value->product_id);
        $cart_item[$key]->product = $product;
        $total += $product->product_price * $value->qty;
    }

    return Inertia::render('GUsers/GUsersCart', ['user' => $user, 'items_in_cart' => $cart_item, 'total' => $total]);
})->name('gusers.cart');

Route::get('/gusers/remove_from_cart/{id}', function (Cart $id, Request $request) {

    $id->delete();
    $user = session('user');
    $total  = 0;
    $cart_item = Cart::where(['user_id' => $user->id])->get();
    foreach ($cart_item as $key => $value) {
        $product = Product::find($value->product_id);
        $cart_item[$key]->product = $product;
        $total += $product->product_price * $value->qty;
    }
    return Inertia::render('GUsers/GUsersCart', ['user' => $user, 'items_in_cart' => $cart_item, 'total' => $total]);
})->name('gusers.remove_from_cart');

Route::post('/addToCart', function (Request $request) {

    $product_id = $request->product_id;
    $user_id = $request->user_id;

    $item_in_cart = Cart::where(['product_id' =>  $product_id, 'user_id' => $user_id])->get();


    if (count($item_in_cart) > 0) {
        $cart_item = $item_in_cart[0];

        $cart_item->qty = $item_in_cart[0]->qty + 1;

        $cart_item->save();
        return response(0);
    } else {
        $cart_item = new Cart();

        $cart_item->product_id = $product_id;
        $cart_item->user_id = $user_id;
        $cart_item->qty = 1;

        $cart_item->save();
        return response(1);
    }
})->name('gusers.product.add_to_cart');

Route::get('/gusers/minus_from_cart/{id}', function (Cart $id, Request $request) {
    $id->qty = $id->qty - 1;

    if ($id->qty == 0) {
        $id->delete();
    } else {
        $id->save();
    }


    $user = session('user');
    $total = 0;
    $cart_item = Cart::where(['user_id' => $user->id])->get();
    foreach ($cart_item as $key => $value) {
        $product = Product::find($value->product_id);
        $cart_item[$key]->product = $product;
        $total += $product->product_price * $value->qty;
    }
    return Inertia::render('GUsers/GUsersCart', ['user' => $user, 'items_in_cart' => $cart_item, 'total' => $total]);
})->name('gusers.minus_from_cart');

Route::get('/gusers/place_order', function (Request $request) {

    $user = session('user');
    $cart_item = Cart::where(['user_id' => $user->id])->get();
    $products_ids = [];
    $products_prices = [];
    $products_names = [];
    $products_qtys = [];
    $products_total = 0;
    foreach ($cart_item as $key => $value) {
        $product = Product::find($value->product_id);
        $cart_item[$key]->product = $product;

        array_push($products_ids, $product->id);
        array_push($products_prices, $product->product_price);
        array_push($products_names, $product->product_name);
        array_push($products_qtys, $value->qty);
        $products_total += $product->product_price * $value->qty;
    }

    $order = new Order();
    $order->products_ids = implode(',', $products_ids);
    $order->products_prices = implode(',', $products_prices);
    $order->products_names = implode(',', $products_names);
    $order->products_qtys = implode(',', $products_qtys);
    $order->products_total = $products_total;
    $order->user_id = $user->id;
    $order->save();

    foreach ($cart_item as $key => $value) {
        $value->delete();
    }

    if (session('user')) {
        $user = session('user');
        $products = Product::all();
        $cart_item = Cart::where(['user_id' => $user->id])->get();

        return Inertia::render('GUsers/GUsersHome', ['user' => $user, 'products' => $products, 'items_in_cart' => count($cart_item)]);
    } else {
        return Inertia::render('GUsers/GUsersLogin');
    }
})->name('gusers.minus_from_cart');

Route::get('/gusers/plus_from_cart/{id}', function (Cart $id, Request $request) {
    if ($id->qty < 1) {
        $id->delete();
    } else {
        $id->qty = $id->qty + 1;
        $id->save();
    }

    $total = 0;
    $user = session('user');
    $cart_item = Cart::where(['user_id' => $user->id])->get();
    foreach ($cart_item as $key => $value) {
        $product = Product::find($value->product_id);
        $cart_item[$key]->product = $product;
        $total += $product->product_price * $value->qty;
    }
    return Inertia::render('GUsers/GUsersCart', ['user' => $user, 'items_in_cart' => $cart_item, 'total' => $total]);
})->name('gusers.plus_from_cart');

Route::get('/gusers/profile', function (Request $request) {
    $user = session('user');
    return Inertia::render('GUsers/GUsersProfile', ['user' => $user]);
})->name('guser.profile');

Route::get('/gusers/myorders', function (Request $request) {
    $user = session('user');
    $orders = Order::where(['user_id' => $user->id])->get();

    foreach ($orders as $key => $order) {
        $user = GUsers::find($order->user_id);
        $orders[$key]->user = $user;
        $orders[$key]->products_names = explode(',', $order->products_names);
        $orders[$key]->products_prices = explode(',', $order->products_prices);
        $orders[$key]->products_qtys = explode(',', $order->products_qtys);
    }
    return Inertia::render('GUsers/GUsersMyOrders', ['user' => $user, 'orders' => $orders]);
})->name('guser.myorders');

Route::post('/gusers/edit/{id}', function (GUsers  $id, Request $request) {
    $id->full_name = $request->full_name;
    $id->email = $request->email;
    $id->phone = $request->phone;
    $id->shipping_address = $request->shipping_address;
    $id->billing_address = $request->billing_address;

    if ($request->password != null) {
        $id->password = Hash::make($request->password);
    }
    $id->save();

    session(['user' => $id]);
    return response(json_encode("Successfully Updated User"));
})->name('gusers.edit');




//SUPER ADMIN
Route::get('/superadmin', function () {
    return Inertia::render('SuperAdmin/Welcome', [
        'canLogin' => Route::has('superadmin.login'),
        'canRegister' => Route::has('superadmin.register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/superadmin/dashboard', function () {
    return Inertia::render('SuperAdmin/Dashboard');
})->middleware(['auth', 'verified'])->name('superadmin.dashboard');

Route::get('/superadmin/users', function () {
    $users = GUsers::all();

    return Inertia::render('SuperAdmin/Users/Users', ['users' => $users]);
})->middleware(['auth', 'verified'])->name('superadmin.users');

Route::get('/superadmin/users/edit/{id}', function (GUsers  $id) {
    return Inertia::render('SuperAdmin/Users/UserEdit', ['user' => $id]);
})->middleware(['auth', 'verified'])->name('superadmin.users.edit');

Route::post('/superadmin/users/edit/{id}', function (GUsers  $id, Request $request) {
    $id->full_name = $request->full_name;
    $id->email = $request->email;
    $id->phone = $request->phone;
    $id->shipping_address = $request->shipping_address;
    $id->billing_address = $request->billing_address;

    if ($request->password != null) {
        $id->password = Hash::make($request->password);
    }
    $id->save();
    return response(json_encode("Successfully Updated User"));
})->middleware(['auth', 'verified'])->name('superadmin.users.edit');

Route::get('/superadmin/users/add', function () {
    return Inertia::render('SuperAdmin/Users/UserAdd');
})->middleware(['auth', 'verified'])->name('superadmin.users.add');

Route::post('/superadmin/users/add', function (Request $request) {

    $id = new GUsers();

    $id->full_name = $request->full_name;
    $id->email = $request->email;
    $id->phone = $request->phone;
    $id->shipping_address = $request->shipping_address;
    $id->billing_address = $request->billing_address;
    $id->password = Hash::make($request->password);
    $id->save();
    return response(json_encode("Successfully Added User"));
})->middleware(['auth', 'verified'])->name('superadmin.users.add');

Route::get('/superadmin/users/toogle_block/{id}', function (GUsers  $id) {
    $id->active = !$id->active;
    $id->save();
    return redirect()->back();
})->middleware(['auth', 'verified'])->name('superadmin.users.edit');

Route::get('/superadmin/users/delete/{id}', function (GUsers $id) {
    $id->delete();
    return redirect()->back();
})->middleware(['auth', 'verified'])->name('superadmin.users.delete');

// STAFF
Route::get('/superadmin/staff', function () {
    $staffs = Staff::all();

    return Inertia::render('SuperAdmin/Staff/Staff', ['staffs' => $staffs]);
})->middleware(['auth', 'verified'])->name('superadmin.staff');

Route::get('/superadmin/staff/edit/{id}', function (Staff  $id) {
    return Inertia::render('SuperAdmin/Staff/StaffEdit', ['staff' => $id]);
})->middleware(['auth', 'verified'])->name('superadmin.staff.edit');

Route::post('/superadmin/staff/edit/{id}', function (Staff  $id, Request $request) {
    $id->full_name = $request->full_name;
    $id->email = $request->email;
    $id->phone = $request->phone;

    if ($request->password != null) {
        $id->password = Hash::make($request->password);
    }
    $id->save();
    return response(json_encode("Successfully Updated Staff"));
})->middleware(['auth', 'verified'])->name('superadmin.staff.edit');

Route::get('/superadmin/staff/toogle_block/{id}', function (Staff  $id) {
    $id->active = !$id->active;
    $id->save();
    return redirect()->back();
})->middleware(['auth', 'verified'])->name('superadmin.staff.edit');

Route::get('/superadmin/staff/delete/{id}', function (Staff $id) {
    $id->delete();
    return redirect()->back();
})->middleware(['auth', 'verified'])->name('superadmin.staff.delete');


Route::get('/superadmin/staff/add', function () {
    return Inertia::render('SuperAdmin/Staff/StaffAdd');
})->middleware(['auth', 'verified'])->name('superadmin.staff.add');

Route::post('/superadmin/staff/add', function (Request $request) {

    $id = new Staff();

    $id->full_name = $request->full_name;
    $id->email = $request->email;
    $id->phone = $request->phone;
    $id->password = Hash::make($request->password);
    $id->save();
    return response(json_encode("Successfully Added Staff"));
})->middleware(['auth', 'verified'])->name('superadmin.staff.add');


//Products

Route::get('/superadmin/products', function () {
    $products = Product::all();

    return Inertia::render('SuperAdmin/Products/Products', ['products' => $products]);
})->middleware(['auth', 'verified'])->name('superadmin.products');


Route::get('/superadmin/products/add', function () {
    return Inertia::render('SuperAdmin/Products/ProductAdd');
})->middleware(['auth', 'verified'])->name('superadmin.products.add');


Route::post('/superadmin/products/add', function (Request $request) {

    $id = new Product();

    $id->product_name = $request->product_name;
    $id->product_cat = $request->product_cat;
    $id->product_price = $request->product_price;
    $id->product_size_or_qty = $request->product_size_or_qty;
    $id->product_description = $request->product_description;
    $id->product_stock = $request->product_stock;
    $id->product_img = 'image url';
    $id->save();
    return response(json_encode("Successfully Added Product"));
})->middleware(['auth', 'verified'])->name('superadmin.staff.add');

Route::get('/superadmin/products/delete/{id}', function (Product $id) {
    $id->delete();
    return redirect()->back();
})->middleware(['auth', 'verified'])->name('superadmin.products.delete');


Route::get('/superadmin/products/edit/{id}', function (Product  $id) {
    return Inertia::render('SuperAdmin/Products/ProductEdit', ['product' => $id]);
})->middleware(['auth', 'verified'])->name('superadmin.product.edit');

Route::post('/superadmin/products/edit/{id}', function (Product  $id, Request $request) {
    $id->product_name = $request->product_name;
    $id->product_cat = $request->product_cat;
    $id->product_price = $request->product_price;
    $id->product_size_or_qty = $request->product_size_or_qty;
    $id->product_stock = $request->product_stock;
    $id->product_description = $request->product_description;


    $id->save();
    return response(json_encode("Successfully Updated Product"));
})->middleware(['auth', 'verified'])->name('superadmin.product.edit');



//STAFF


Route::get('/staff', function () {

    if (session('staff_user')) {
        $staff_user = session('staff_user');

        return Inertia::render('Staff/StaffHome', ['staff_user' => $staff_user]);
    } else {
        return Inertia::render('Staff/StaffLogin');
    }
})->name('staff.home');

Route::get('/staff/login', function () {
    if (session('staff_user')) {
        $staff_user = session('staff_user');
        return Inertia::render('Staff/StaffHome', ['staff_user' => $staff_user]);
    } else {
        return Inertia::render('Staff/StaffLogin');
    }
})->name('staff.login');


Route::post('/staff/login', function (Request $request) {

    $staff_user = Staff::where('email', $request->email)->get();

    if (count($staff_user) > 0) {
        if (Hash::check($request->password, $staff_user[0]->password)) {
            if ($staff_user[0]->active == 0) {
                return response(-1);
            } else {
                session(['staff_user' => $staff_user[0]]);
                return response(1);
            }
        } else {
            return response(2);
        }
    } else {
        return response(0);
    }
})->name('staff.login');

Route::get('/staff/profile', function (Request $request) {

    $staff_user = session('staff_user');

    return Inertia::render('Staff/StaffProfile', ['staff_user' => $staff_user]);
})->name('staff.profile');


Route::get('/staff/logout', function () {
    session(['staff_user' => null]);
    return Inertia::render('Staff/StaffLogin');
})->name('staff.logout');



Route::get('/staff/users', function () {
    $users = GUsers::all();
    $staff_user = session('staff_user');

    return Inertia::render('Staff/Users/Users', ['users' => $users, 'staff_user' => $staff_user]);
})->name('staff.users');



Route::get('/staff/users/edit/{id}', function (GUsers  $id) {
    $staff_user = session('staff_user');

    return Inertia::render('Staff/Users/UserEdit', ['user' => $id, 'staff_user' => $staff_user]);
})->name('staff.users.edit');

Route::post('/staff/users/edit/{id}', function (GUsers  $id, Request $request) {
    $id->full_name = $request->full_name;
    $id->email = $request->email;
    $id->phone = $request->phone;
    $id->shipping_address = $request->shipping_address;
    $id->billing_address = $request->billing_address;

    if ($request->password != null) {
        $id->password = Hash::make($request->password);
    }
    $id->save();
    return response(json_encode("Successfully Updated User"));
})->name('staff.users.edit');

Route::get('/staff/users/toogle_block/{id}', function (GUsers  $id) {
    $id->active = !$id->active;
    $id->save();
    return redirect()->back();
})->name('staff.users.block');


Route::get('/staff/users/delete/{id}', function (GUsers $id) {

    $id->delete();
    return redirect()->back();
})->name('staff.users.delete');


Route::get('/staff/change_order_status/{id}', function (Order $id) {
    if ($id->order_status == 1) {
        $id->order_status = 2;
        $id->save();
        return redirect()->back();
    } else if ($id->order_status == 2) {
        $id->order_status = 3;
        $id->save();
        return redirect()->back();
    }


    // echo json_encode($id->order_status);
    // exit;
    // $id->delete();

})->name('staff.order_status_change');

Route::get('/staff/orders', function () {
    $orders = Order::all();

    foreach ($orders as $key => $order) {
        $user = GUsers::find($order->user_id);
        $orders[$key]->user = $user;
        $orders[$key]->products_names = explode(',', $order->products_names);
        $orders[$key]->products_prices = explode(',', $order->products_prices);
        $orders[$key]->products_qtys = explode(',', $order->products_qtys);
    }

    // echo json_encode($orders);
    // exit;

    $staff_user = session('staff_user');

    return Inertia::render('Staff/StaffOrders', ['staff_user' => $staff_user, 'orders' => $orders]);
})->name('staff.orders');

Route::post('/addReview', function (Request $request) {
    // echo json_encode($request->all());
    // exit;

    $review = new Reviews();
    $user = session('user');

    $review->review = $request->review;
    $review->user_name = $user->full_name;
    $review->product_id = $request->product_id;
    $review->save();

    return redirect()->back();
})->name('staff.addReview');

Route::post('/addQuery', function (Request $request) {
    // echo json_encode($request->q);
    $query = new Query();
    $user = session('user');

    $query->query = $request->q;
    $query->user_id = $user->id;
    $query->save();
    // $query->save();
})->name('guser.addQuery');

Route::post('/addAnswer', function (Request $request) {

    $answer = new Answer();

    $answer->answer = $request->answer;
    $answer->q_id = $request->q_id;
    $answer->save();
})->name('guser.addAnswer');

Route::get('/gusers/support', function () {

    $user = session('user');
    $queries  = Query::where(['user_id' => $user->id])->get();
    foreach ($queries as $key => $q) {
        $answer = Answer::where(['q_id' => $q->id])->get();

        $queries[$key]->answer = $answer;
    }

    return Inertia::render('GUsers/GUsersSupport', ['user' => $user, 'queries' => $queries]);
})->name('guser.support');

Route::get('/staff/queries', function () {

    $staff_user = session('staff_user');
    $queries  = Query::all();
    foreach ($queries as $key => $q) {
        $user = GUsers::find($q->user_id);
        $answer = Answer::where(['q_id' => $q->id])->get();

        $queries[$key]->user = $user;
        $queries[$key]->answer = $answer;
    }

    // echo json_encode($queries);
    // exit;
    return Inertia::render('Staff/Users/UserSupport', ['staff_user' => $staff_user, 'queries' => $queries]);
})->name('staff.qiueris');

Route::get('/staff/products', function () {

    $staff_user = session('staff_user');
    $products = Product::all();

    return Inertia::render('Staff/StaffProducts', ['staff_user' => $staff_user, 'products' => $products]);
})->name('staff.products');


require __DIR__ . '/auth.php';
