<?php

namespace Pkg\Mail;

use PHPMailer\PHPMailer\PHPMailer;

class MailSender {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();

        $this->mailer->isSMTP();
        $this->mailer->Host = 'smtp.gmail.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = ''; // Your SMTP email/username
        $this->mailer->Password = ''; // Your SMTP password
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = 587;
    }

    public function send($to, $subject, $message) {
        $this->mailer->setFrom('email@example.com','name');
        $this->mailer->addAddress($to);
        $this->mailer->Subject = $subject;
        $this->mailer->Body = $message;

        try {
            $this->mailer->send();
            return true;
        } catch (\Exception $e) {

            return false;
        }
    }
}