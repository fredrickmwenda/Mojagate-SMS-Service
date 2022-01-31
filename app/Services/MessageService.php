<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use GuzzleHttp\Client;

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
       
        // $client = new Client();
        

        // $response = $client->post(
        //     $this->apiURl,
        //     dd($this->apiURl),
        //     [
        //         'headers' => [
        //             'Accept' => 'application/json',
        //         ],
        //         'json' => [
        //             'email' => $this->username,
        //             'password' => $this->password,
        //         ],
        //     ]
        // );
        // dd($response);
        // $body = $response->getBody();
        // dd(json_decode((string) $body));
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
        
        

        // //return the token to be used to send the email
        return $token['data']['token'];
        // Cache::put('token',$token['json']['token']);

    }

    public function sendSMS(String $phone,String $message, $id){     
        $query = $this->apiAuthentication();
        
         
        $headers = [
           'Authorization' => 'Bearer '.$this->apiAuthentication(),
           'Accept' => 'application/json',
       ];

        $json =[
            'from' => 'MOJAGATE',
            'phone' => $phone,
            'message' => $message,
            'message_id' => $id,
            'webhook_url' => "https://mojagate.com/sms-webhook" ,   
        ];

        $sendMessage =  Http::withHeaders($headers)->post($this->apiUrl.'/sendsms',$json)->json();

        return $sendMessage;

    }




}
