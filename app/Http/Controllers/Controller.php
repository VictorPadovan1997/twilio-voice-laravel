<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\TwiML\VoiceResponse;
use Illuminate\Http\Request;
use Twilio\Jwt\ClientToken;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {

    	return view("index");

    }

    public function token(Request $request) {

    	$data = $request->all();
    	$twilioAccountSid = env("TWILIO_ACCOUNT_SID");
		$twilioApiKey = env("TWILIO_API_KEY");
		$twilioApiSecret = env("TWILIO_API_SECRET");
		$outgoingApplicationSid = env("TWILIO_SID");

		$identity = $data["identity"]; // Jack // Client name
		$token = new AccessToken(
		    $twilioAccountSid,
		    $twilioApiKey,
		    $twilioApiSecret,
		    3600,
		    $identity
		);

		$voiceGrant = new VoiceGrant();
		$voiceGrant->setOutgoingApplicationSid($outgoingApplicationSid);
		$voiceGrant->setIncomingAllow(true);
		$token->addGrant($voiceGrant);

		return response()->json([
			"identity" => $identity,
			"token" => $token->toJWT()
		]);

    }

    public function voice(Request $request) {

    	$data = $request->all();
    	$response = new VoiceResponse();
		$dial = $response->dial('', ['callerId' => $data["outgoing_caller_id"]]);
		$client = $dial->client($request->To);
		$client->parameter([
            "name" => "outgoing_caller_id",
            "value" => $data["outgoing_caller_id"],
        ]);



		return $response;

    }
}
