- GET TOKEN

Access this URL 'https://twiliovoiceapilaravel.herokuapp.com/token'

- Method: **POST**

passing in the body of your request the identity body: idenficador.



![stack Overflow](https://i.ibb.co/NSVwNRR/Captura-de-Tela-2021-11-28-a-s-07-56-10.png)

 - VOICE

include the request Voice in the twilio console responsible for calling the identifier.

Access this URL 'https://twiliovoiceapilaravel.herokuapp.com/voice'

- Method: **POST**

passing in the body of your request the To and From

![stack Overflow](https://i.ibb.co/VHGdn22/Captura-de-Tela-2021-11-28-a-s-08-01-04.png)




Apis:

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
