<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginHandler extends Model
{
    //
    public function __construct()
    {
        $this->auth = app('firebase.auth');
    }

    public function verifyLoginData($arrPostData=array()){
        $arrReturnData = array();
        if(!empty($arrPostData)){
            $auth                         = $this->auth;
            $email                        = $arrPostData['email'];
            $clearTextPassword            = $arrPostData['password'];
            //dd($clearTextPassword);

            //Check if valid user           
            try {
                $signInResult           = $auth->signInWithEmailAndPassword($email, $clearTextPassword);
                $idTokenString          = $signInResult->idToken();
                $arrData                = $signInResult->data();
                $userid                 = $arrData['localId'];
                //dd($userid);

                $arrReturnData['userid']        = $userid;
                $arrReturnData['fb_token']      = $idTokenString;
            } catch (\Exception $e) {
                $arrReturnData['error'] = 'error';
            }
        }  
        
        return $arrReturnData;      
    }

    public function registerNewUser($arrPostData=array()){
        
        $arrReturnData = array();
        if(!empty($arrPostData)){
            $auth                         = $this->auth;
            $name                         = $arrPostData['name'];
            $email                        = $arrPostData['email'];
            $clearTextPassword            = $arrPostData['password'];
            //dd($clearTextPassword);
            
            $userProperties = [
                'email' => $email,
                'emailVerified' => false,
                'password' => $clearTextPassword,
                'displayName' => $name,
            ];
          
            try {
                $createdUser    = $auth->createUser($userProperties);
                $arrReturnData['msg'] = 'success';
            } catch (\Exception $e) {
                $arrReturnData['msg'] = $e;
            }
        } 
        
        return json_encode($arrReturnData);
    }    
}
