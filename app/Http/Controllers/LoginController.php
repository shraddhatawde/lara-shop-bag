<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginHandler;

class LoginController extends Controller
{
    //
    public function __construct()
    {      
    }

    public function login(){
        $errmsg = '';
        if(!empty($request->err) && $request->err == '1'){
            $errmsg = 'Invalid Login Credentials';
        }elseif(!empty($request->err) && $request->err == '2'){
            $errmsg = 'User registered successfully. Please login to continue.';
        }
        return view('firebase_auth\login', ['errmsg' => $errmsg]);
    }

    public function loginVerify(Request $request){
        $postData                   = $request->all();
       
        $arrPostData                = array();
        $arrPostData['email']       = $request->email;
        $arrPostData['password']    = $request->password;
        
        $objLoginHandler            = new LoginHandler();
        $arrValidateLogin           = $objLoginHandler->verifyLoginData($arrPostData);
        
        //If no error then set session
        if(!empty($arrValidateLogin) && !empty($arrValidateLogin['userid'])){
            //set idTokenString and userid in session
            $request->session()->put('userid', $arrValidateLogin['userid']);
            $request->session()->put('fb_token', $arrValidateLogin['fb_token']); 
            return redirect()->action('FirebaseController@dashboard');            
        }else{            
            return redirect()->action('LoginController@login', ['err'=>'1']);
        }
    }

    public function register(){
        return view('firebase_auth\register');
    }

    public function registerUser(Request $request){
        $postData                   = $request->all();
       
        $arrPostData                = array();
        $arrPostData['name']        = $request->name;
        $arrPostData['email']       = $request->email;
        $arrPostData['password']    = $request->password;
        
        //Insert into DB
        $objLoginHandler            = new LoginHandler();
        $arrRegisterUser            = $objLoginHandler->registerNewUser($arrPostData);
        
        //return redirect()->action('LoginController@login');
        return redirect()->action('LoginController@login', ['err'=>'2']);
    }
    
    public function logout(Request $request){
        //Get userid from session
        $userid              = $request->session()->get('userid');
        $idTokenString       = $request->session()->get('fb_token');
        //dd($idTokenString);

        //Revoke from Firebase
        $auth    = app('firebase.auth');
        try {
            $auth->revokeRefreshTokens($idTokenString);
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
        
        //Unset session
        $request->session()->forget(['userid', 'fb_token', 'cart']);

        return redirect()->action('LoginController@login');
    }
}

