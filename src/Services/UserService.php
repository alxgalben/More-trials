<?php
namespace App\Services;

class UserService {
    private $mailer;
    public function __construct (MailerInterface $mailer) {
        $this->mailer = $mailer;
    }
}