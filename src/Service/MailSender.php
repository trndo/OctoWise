<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 02.01.19
 * Time: 21:20
 */

namespace App\Service;


use App\Entity\Contacts;
use Twig\Environment;


class MailSender
{
    private $mailer;

    private $template;

    public function __construct(\Swift_Mailer $mailer,Environment $template)
    {
        $this->mailer = $mailer;
        $this->template = $template;
    }

    public function sendMessage(Contacts $data)
    {
        $message1 = (new \Swift_Message('Compania Oriflame'))
            ->setFrom('OctoWice@gmail.com')
            ->setTo('OctoWice@gmail.com')
            ->setBody(
                $data->getName().'<br>'.$data->getEmail().'<br>'.$data->getTelNumber().'<br>'.$data->getInformation(),
                'text/html'
            );
        $message2 = (new \Swift_Message('Web-studio OctoWice'))
            ->setFrom('OctoWice@gmail.com')
            ->setTo($data->getEmail())
            ->setBody(
                $this->template->render(
                    'components/mail.html.twig'
                )
                ,
                    'text/html');

        $this->mailer->send($message1);
        $this->mailer->send($message2);
    }

}