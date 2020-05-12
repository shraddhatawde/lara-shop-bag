<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FirebaseTransactions;
use Illuminate\Routing\Controller;

class FirebaseController extends Controller
{
    //
    public function __construct()
    {        
    }

    public function dashboard(){
        $objFirebaseTransactions    = new FirebaseTransactions();
        $products                   = $objFirebaseTransactions->getDashboardData();

        return view('shop\dashboard', ['products' => $products]);
    }

    public function addProduct(){
        $db = app('firebase.database');

        /************************* Insert into DB ******************************/
        $db->getReference('products/product_3')
            ->set([
                'name' => 'Paradise is Real Backpack',
                'description' => "This all-over Palm tree print backpack has a lot of room with a big inner pocket, a separate section for a 15 inch laptop, a front pocket, and a hidden pocket at the back for smaller valuables. The bag is made of a water-resistant material. The soft, padded mesh material on the back and the handles make it perfect for daily use or sporting activities.",
                'currency' => 'Rs.',
                'price' => '1500',
                'img_path' => '/svg/pink_sack.jpg',
            ]);

        $db->getReference('products/product_3/id')->set('3');
        /************************* Insert into DB ******************************/
    }

    public function saveWishlist(Request $request){
        $userid                     = $request->session()->get('userid');
        
        if(!empty($userid)){ 
            $pid                        = $request->id;
            $objFirebaseTransactions    = new FirebaseTransactions();
            $saveWish                   = $objFirebaseTransactions->addToWishlist($pid,$userid);

            return $saveWish;
        }else{
            return json_encode('nologin');
        }
    }

    public function showWishlist(Request $request){
        $userid = $request->session()->get('userid');
        //dd($userid);

        //If user is logged in display wishlist else redirect to dashboard
        if(!empty($userid)){
            $objFirebaseTransactions    = new FirebaseTransactions();
            $wishlistProducts           = $objFirebaseTransactions->showUserWishlist($userid);

            return view('shop\dashboard', ['products' => $wishlistProducts]);
        }else{
            return redirect()->action('FirebaseController@dashboard');
        }
    }

    public function addToCart(Request $request){
        $userid         = $request->session()->get('userid');

        if(!empty($userid)){ 
            $pid            = $request->id;
            $arrCartData    = array();

            //Check if session exists
            if(!empty($request->session()->get('cart'))){
                $arrCartData = $request->session()->get('cart');
            }
            
            $arrCartData[] = $pid;
            $request->session()->put('cart', $arrCartData);
            return json_encode('success');
        }else{
            return json_encode('nologin');
        }
    }

    public function showCart(Request $request){
        $userid = $request->session()->get('userid');

        //If user is logged in display cart else redirect to dashboard
        if(!empty($userid)){            
            $arrCartData                = $request->session()->get('cart');
            $objFirebaseTransactions    = new FirebaseTransactions();
            $cartProducts               = $objFirebaseTransactions->showCartDetails($userid,$arrCartData);

            return view('shop\dashboard', ['products' => $cartProducts]);
        }else{
            return redirect()->action('FirebaseController@dashboard');
        }
    }
}
