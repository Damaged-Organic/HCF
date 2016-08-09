<?php
// src/AppBundle/Service/MailerShortcut.php
namespace AppBundle\Service;

use Swift_Message,
    Swift_Attachment;

class MailerShortcut
{
    private $_mailer;

    public function __construct($mailer)
    {
        $this->_mailer = $mailer;
    }

    public function sendMail($from, $to, $subject, $body, $attachment = NULL)
    {
        $message = Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body, 'text/html');

        if( $attachment )
        {
            if( !is_array($attachment) ) {
                $message->attach($attachment);
            } else {
                foreach($attachment as $resource) {
                    if( $resource instanceof Swift_Attachment ) {
                        $message->attach($resource);
                    }
                }
            }
        }

        return ( $this->_mailer->send($message) ) ? TRUE : FALSE;
    }
}