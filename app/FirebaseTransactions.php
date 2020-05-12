<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirebaseTransactions extends Model
{
    //
    public function __construct()
    {
        $this->db = app('firebase.database');
    }

    public function getDashboardData(){
        $db = $this->db;

        //Get all Products
        $prod_reference = $db->getReference('products');
        $arrAllProducts = $prod_reference->getValue();

        //dd($arrAllProducts);
        $products       = json_encode($arrAllProducts);
        return $products;
    }

    public function addToWishlist($pid,$userid){
        $db = $this->db;
        
        // Create a key for a new post
        $newWishlistKey = $db->getReference('wishlist')->push()->getKey();

        $updates = [
            'wishlist/'.$userid.'/'.$newWishlistKey => $pid,
        ];

        $db->getReference() // this is the root reference
        ->update($updates);

        return json_encode('success');
    }

    public function showUserWishlist($userid){
        $db = $this->db;
        
        //Get userid wise wishlist
        $wish_reference     = $db->getReference('wishlist/'.$userid); //wishlist
        $arrUserWishlist    = $wish_reference->getValue();
        //dd($arrUserWishlist);

        $arrWishProducts = array();
        if(!empty($arrUserWishlist)){
            foreach($arrUserWishlist as $pVal){
                $prod_reference             = $db->getReference('products/'.$pVal); //wishlist
                $arrWishProducts[$pVal]     = $prod_reference->getValue();
            }
        }
        //dd($arrWishProducts);

        $WishProducts       = json_encode($arrWishProducts);
        return $WishProducts;
    }

    public function showCartDetails($userid,$arrCartData){
        $db                 = $this->db;
        $arrCartProducts    = array();
        if(!empty($arrCartData)){
            foreach($arrCartData as $pVal){
                $prod_reference             = $db->getReference('products/'.$pVal); //wishlist
                $arrCartProducts[$pVal]     = $prod_reference->getValue();
            }
        }
        //dd($arrCartProducts);

        $cartProducts       = json_encode($arrCartProducts);
        return $cartProducts;
    }
}
