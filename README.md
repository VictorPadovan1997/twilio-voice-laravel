http://localhost/twilio-voice-laravel/token

http://localhost/twilio-voice-laravel/voice

```
public function token(Request $request) {
    	$data = $request->all();
    	$twilioAccountSid = env("TWILIO_ACCOUNT_SID");
		$twilioApiKey = env("TWILIO_API_KEY");
		$twilioApiSecret = env("TWILIO_API_SECRET");
		$outgoingApplicationSid = env("TWILIO_SID");
        $setPushCredentialSid = env("TWILIO_CREDENCIAL_SID_ANDROID");

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
        $voiceGrant->setPushCredentialSid($setPushCredentialSid);
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
		$from = $data["From"];
		$to = $data["To"];
		$dial = $response->dial('', ['callerId' => $from]);
		$client = $dial->client($to);

		return $response;

    }
