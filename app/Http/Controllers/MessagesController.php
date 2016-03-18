<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Request;

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
        return view('messages.index');
    }

    public function send(){
        $input = Request::all();
        $messages = ["Hey {$input['name']}, Altius Mortgage has received your loan application, but we need your permission to access your credit report.",'Reply YES to to consent, NO to decline.'];

        $creditRequest = new CreditRequest($input);
        $creditRequest->message = implode('',$messages);

        //send message
        $params = array(
            'src' => config('services.plivo.number'), // Sender's phone number with country code
            'dst' => '1'.$input['phone'], // Receiver's phone number with country code
            'text' => $messages[0] // SMS text message
        );

        $response = $this->messenger->send_message($params);
        //TODO:handle errors;
        $params['text'] = $messages[1];

        $response = $this->messenger->send_message($params);
        //TODO:handle errors;
        //on success log to requests
        $creditRequest->save();
        //return success response
        //redirect to success screen

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
