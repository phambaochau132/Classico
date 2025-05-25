<?php
// app/Services/SMSService.php
namespace App\Services;

use Twilio\Rest\Client;

class SMSService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(config('services.twilio.sid'), config('services.twilio.token'));
    }

    public function send($to, $message)
    {
        $this->twilio->messages->create($to, [
            'from' => config('services.twilio.from'),
            'body' => $message,
        ]);
    }
}
