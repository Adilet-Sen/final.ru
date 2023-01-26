<?php

namespace App\models;

use Swift_Mailer;
use Delight\Auth\Auth;
use Swift_Message;
use App\models\Notifications;

class RegistrationService
{
    private $auth;
    private $database;
    private $notifications;

    public function __construct(Auth $auth, QueryBuilder $database, Notifications $notifications)
    {
        $this->auth = $auth;
        $this->database = $database;
        $this->notifications = $notifications;
    }

    public function make($email, $password, $username)
    {
        $userId = $this->auth->register($email, $password, $username, function ($selector, $token) use ($email) {
            // send `$selector` and `$token` to the user (e.g. via email)
            $this->notifications->emailWasChanged($email, $selector, $token);
        });

        $this->database->update('users', ['roles_mask' =>  Roles::USER], $userId);

        return $userId;
    }

    public function verify($selector, $token)
    {
        return $this->auth->confirmEmail($selector, $token);
    }
}
