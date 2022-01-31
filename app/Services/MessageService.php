<?php

namespace App\Services;


use Illuminate\Support\Facades\Http;


class MessageService 
{
    //
    protected $username;
    protected $password;
    protected $apiURl;
    
    
    public function __construct(String $username, String $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = env('MOJAGATE_API');
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
        $token = Http::withHeaders($headers)->post($this->apiUrl.'/login',$json)->json();
        // dd($token['data']['token']);
        
        
        // //return the token to be used for authentication verification
        return $token['data']['token'];
       

    }

    public function sendSMS(String $phone,String $message, String $message_id ){     
        $query = $this->apiAuthentication();
        
         
        $headers = [
           'Authorization' => 'Bearer '.$this->apiAuthentication(),
           'Accept' => 'application/json',
       ];

        $json =[
            'from' => 'MOJAGATE',
            'phone' => $phone,
            'message' => $message,
            'message_id' => $message_id,
            'webhook_url' => env('WEBHOOK_URL'),   
        ];
        

        $sendMessage =  Http::withHeaders($headers)->post($this->apiUrl.'/sendsms',$json)->json();
        // dd($sendMessage);

        return $sendMessage;

    }




}
