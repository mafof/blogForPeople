<?php
namespace App\Core;

use PHPMailer\PHPMailer\PHPMailer;

class Mail {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer;
        $this->configurateMail();
    }

    private function configurateMail() {
        global $CONFIG_MAIL;

        $this->mail->isSMTP();
        $this->mail->Host = $CONFIG_MAIL['smtpHost'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $CONFIG_MAIL['email'];
        $this->mail->Password = $CONFIG_MAIL['password'];
        $this->mail->Port = '465';
    }

    public function sendEmail($to, $toName, $subject, $body, $name = 'Administration blog') {
        global $CONFIG_MAIL;

        $this->mail->setFrom($CONFIG_MAIL['email'], $name);
        $this->mail->addAddress($to, $toName);

        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body;
        $this->mail->send();
    }
}