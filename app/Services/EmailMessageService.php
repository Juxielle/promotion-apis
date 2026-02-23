<?php

namespace App\Services;

use App\Classes\Mail;

class EmailMessageService
{
    public static function sendConfirmResponse($name, $code, $emails = []): Mail
    {
        return new Mail(
            recipients: $emails,
            subject: "Jamil - Votre code de confirmation.",
            body: "Votre code de confirmation est: {$code}.",
            greeting: sprintf("Bonjour", $name),
            thanks: 'Merci de nous notifier de la reception du bon.'
        );
    }
}
