<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 28.12.18
 * Time: 14:50
 */

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactsType;
use App\Service\MailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactsController extends AbstractController
{
    /**
     * @Route("/sendEmail",name="contacts")
     */
    public function addToLog(Request $request,MailSender $mail)
    {
        $contacts = new Contacts();
        $form = $this->createForm(ContactsType::class,$contacts);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $mail->sendMessage($data);
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute('home');
        }
        return $this->render('components/contactForm.html.twig', [
            'form' => $form->createView()
        ]);
    }



}