<?php
namespace App\Notification;

use App\Entity\Contact;
use Swift_Mailer;
use Swift_Message;
use Twig\Environment;


class ContactNotification {

    private $mailer;
    private $renderer;
    

    public function __construct(Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;

    }
    public function notify(Contact $contact) {

        $message = (new Swift_Message('Agence : ' . $contact->getProperty()->getTitle()))
            ->setFrom('noreply@server.fr')
            ->setTo('contact@agence.fr')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->renderer->render('emails/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }

    /**
     * Get the value of mailer
     */ 
    public function getMailer()
    {
        return $this->mailer;
    }

    /**
     * Set the value of mailer
     *
     * @return  self
     */ 
    public function setMailer($mailer)
    {
        $this->mailer = $mailer;

        return $this;
    }

    /**
     * Get the value of renderer
     */ 
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Set the value of renderer
     *
     * @return  self
     */ 
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }
}