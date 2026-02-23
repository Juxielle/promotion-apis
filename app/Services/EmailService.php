<?php

namespace App\Services;

use App\Classes\Mail;
use App\Classes\Result;
use Exception;
use Illuminate\Support\Facades\Notification;


class EmailService
{
    public function __construct()
    {
    }

    /**
     * @throws Exception
     */
    public static function send($route, $notification): Result
    {
        if (!($notification instanceof Mail)) {
            $message = "Excepted MailInterface instance, actual " . get_class($notification);
            //$this->processLogger->getLogger()->critical($message);
            throw new Exception($message);
        }
        //Mail::to('juxiharold@gmail.com')->send(new WelcomeEmail());

        try {
            Notification::route("mail", $route)->notify($notification);
        } catch (Exception $e) {
            //$this->processLogger->getLogger()->critical($e->getMessage());
            //$this->processLogger->getLogger()->critical($e->getTraceAsString());
        }
    }
}
