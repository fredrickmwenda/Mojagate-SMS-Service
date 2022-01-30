<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageService 
{
    //
    private $username;
    private $password;
    private $apiUrl = "https://api.mojasms.dev";
    public function __construct(String $username, String $password, String $apiUrl)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = $apiUrl;
        $this->apiAuthentication();
        
    }

    public function apiAuthentication(){
        $headers = [
            'Accept' => 'application/json',
        ];
        $json = [
            'email' => $this->username,
            'password' => $this->password,
        ];

        //Generate the token 
        $token = $token = Http::withHeaders($headers)->post($this->apiUrl.'/login',$json)->json();

        //return the token to be used to send the email
        return $token;

    }

    public function sendSMS(String $phone,String $message, $id){     
        $query = $this->apiAuthentication();
         
        $headers = [
           'Authorization' => 'Bearer '.$this->$query,
           'Accept' => 'application/json',
       ];

        $json =[
            'from' => 'MOJAGATE',
            'phone' => $phone,
            'message' => $message,
            'message_id' => $id,
            'webhook_url' => "https://mojagate.com/sms-webhook" ,   
        ];

        $sendMessage =  Http::withHeaders($headers)->post($this->url.'/sendsms',$json)->json();

        return $sendMessage;

    }


}
