<?php

namespace App\models;

class Notifications
{
    private $mailer;

    public function __construct(Mail $mailer)
    {
        $this->mailer = $mailer;
    }

    public function emailWasChanged($email, $selector, $token)
    {
        //Используем $email для отправки вместо gtestovik39@gmail.com
        $message = 'http://final.ru/verify_email?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
        $this->mailer->send($email, $message); // используем вместо gtestovik39@gmail.com
    }

    public function passwordReset($email, $selector, $token)
    {
        //Используем $email для отправки вместо gtestovik39@gmail.com
        $message = 'http://final.ru/password-recovery/form?selector=' . \urlencode($selector) . '&token=' . \urlencode($token);
        $this->mailer->send($email, $message); // используем вместо gtestovik39@gmail.com
    }
}
