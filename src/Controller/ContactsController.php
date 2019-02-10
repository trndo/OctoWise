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
     * @Route("/addToLog",name="contacts")
     */
    public function addToLog(Request $request,MailSender $mail)
    {
        $contacts = new Contacts();
        $form = $this->createForm(ContactsType::class,$contacts);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            //$this->addFlash('notice','mail sent');
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            return $this->redirectToRoute('sendEmail',['id'=> $data->getId()]);
        }
        return $this->render('components/contactForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/sendEmail",name="sendEmail")
     */
    public function sendEmail(Request $request, MailSender $mail)
    {
        $inform = $request->query->get('id');
        $repoContacts = $this->getDoctrine()->getRepository(Contacts::class);
        $data = $repoContacts->findOneBy(['id' => $inform]);

        $mail->sendMessage($data);

        return $this->redirectToRoute('/');
    }

}