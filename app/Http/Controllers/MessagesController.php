<?php

namespace App\Http\Controllers;

use Request;
use User;
use App\Http\Requests;
use Plivo\RestAPI;
use App\CreditRequest;

class MessagesController extends Controller
{
    private $messenger;

    public function __construct()
    {
        $this->messenger = new RestAPI(config('services.plivo.id'), config('services.plivo.token'));
    }

    public function index(){
        return "this works";
        return view('messages.index');
    }

    public function send(){
        $input = Request::all();

        $creditRequest = new CreditRequest($input);

        //send message
        $params = [
            'src' => config('services.plivo.number'), // Sender's phone number with country code
            'dst' => '1'.$input['phone'], // Receiver's phone number with country code
            'text' => sprintf(config('textauth.message'),$input['name'],'Ryan Robinson', 'Altius Mortgage') // SMS text message
        ];
        dd($params);
        $response = $this->messenger->send_message($params);
        if($response['status'] === 200) {
            $creditRequest->request_uuid = $response['message_uuid'][0];
            $creditRequest->request_response = json_encode($response);
        } else {
            //TODO: log error
            //text sender about error
        }

        return $response;
    }

    public function receive(){
        //check response message - resend message if response not recognized
        //find request - log error if not found, check response
        //log to authorizations
        //delete from requests

        //generate pdf
        //email pdf confirmation

        //return json response

        // Sender's phone numer
        $from_number = $_REQUEST["From"];
        // Receiver's phone number - Plivo number
        //$to_number = $_REQUEST["To"];
        // The SMS text message which was received
        $text = $_REQUEST["Text"];
        // Output the text which was received, you could
        // also store the text in a database.
        return "Message received from $from_number : $text";
    }
}
