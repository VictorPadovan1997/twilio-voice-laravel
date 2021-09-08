<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CallControllerTest extends TestCase
{
    public function testNewCallWithPhoneNumber()
    {
        $fakeCustomerNumber = '+15558736333';

        $response = $this->call(
            'POST',
            'https://localhost/twilio-voice-laravel/voice',
            ['phoneNumber' => $fakeCustomerNumber]
        );
        $responseDocument = json_decode(($response->getContent()));
        $this->assertNotNull($responseDocument->Dial);
        $this->assertNotNull($responseDocument->Dial->Number);
        $this->assertEquals(
            $fakeCustomerNumber,
            $responseDocument->Dial->Number
        );
        $this->assertEquals(
            $responseDocument->Dial->attributes()['callerId'],
            config('services.twilio')['number']
        );
    }

    public function testNewCallWithoutPhoneNumber()
    {
        $response = $this->call(
            'POST',
            'https://localhost/twilio-voice-laravel/voice'
        );
        $responseDocument = json_decode($response->getContent());

        $this->assertNotNull($responseDocument->Dial);
        $this->assertNotNull($responseDocument->Dial->Client);
        $this->assertEquals('support_agent', $responseDocument->Dial->Client);
        $this->assertEquals(
            $responseDocument->Dial->attributes()['callerId'],
            config('services.twilio')['number']
        );
    }
}
