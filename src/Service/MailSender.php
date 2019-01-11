<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 02.01.19
 * Time: 21:20
 */

namespace App\Service;


use App\Entity\Contacts;

class MailSender
{
    private $mailer;
    private $message;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
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
        $message2 = (new \Swift_Message('Компанія ЙобанаСрака'))
            ->setFrom('OctoWice@gmail.com')
            ->setTo($data->getEmail())
            ->setBody(
                $data->getName().' - хуй ми вам зробимо сайт.Платіть 1000000000$ - потым поговоримо!!!',
                'text/html'
            );

        $this->mailer->send($message1);
        $this->mailer->send($message2);
    }

}