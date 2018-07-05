<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        $messages = $this->readSms();
        return view('message')->with('messages',$messages);
    }
    public function readSms()
    {       
        $content = json_encode([
            'filters' => [
                [
                    // [
                    //     'field' => 'message',
                    //     'operator' => 'like',
                    //     'value' => '%Hello World%'
                    // ],
                    [
                        'field' => 'status',
                        'operator' => '=',
                        'value' => 'Received'
                    ],
                    [
                        'field' => 'device_id',
                        'operator' => '=',
                        'value' => '95451'
                    ]
                ]
            ],
            'order_by' => [
                [
                    'field' => 'created_at',
                    'direction' => 'DESC'
                ]
            ]
        ]);
        // dd($content);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://smsgateway.me/api/v4/message/search",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $content,
        CURLOPT_HTTPHEADER => array(
            "Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzMDgwNDcwMSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjU2MzQ1LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.caxPwJZ-NKebIeo5LO6n8yEbbr2u0zto4Oc2inq_Mbk",
            "Content-Type: application/json"
        ),
        ));
        
        $response = json_decode(curl_exec($curl));
        
        curl_close($curl);

        return $response->results;
    }
}
