<?php

namespace App\Mail;

use App\Notification;

class SendgirdMail
{

    private $email;
    private $notification;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $this->email = new \SendGrid\Mail\Mail();
        $this->notification = $notification;
        $this->build();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    private function build()
    {
        $this->email->setFrom("rdv@cabinet.ma", "Cabinet");
        $this->email->setSubject($this->notification->subject);
        $this->email->addTo($this->notification->patient->email, $this->notification->patient->name);
        $this->email->addContent(
            "text/html", "<strong>{$this->notification->content}</strong>"
        );
    }

    public function send()
    {
        $sendgrid = new \SendGrid(env('SENDGRID_SECRET'));
        try {
            $response = $sendgrid->send($this->email);
        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
