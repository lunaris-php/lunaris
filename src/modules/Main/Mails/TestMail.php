<?php

    namespace Module\Main\Mails;

    use Lunaris\Mailer\Mail;
    use Lunaris\Mailer\Interface\MailInterface;
    
    class TestMail extends Mail implements MailInterface
    {
        public function handle(array $args): void {
            $this->receiver("bhaswanth22@gmail.com", "Bhaswanth");
            $this->subject("Test Message For :: {$args['name']}");
            $this->content("mails.test_mail", $args);
        }
    }