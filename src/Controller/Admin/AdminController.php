<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 23.12.18
 * Time: 14:00
 */

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/adminPanel",name="adminPanel")
     */
    public function admin()
    {
        $repoArticles = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repoArticles->findAll();

        return $this->render('adminPanel.html.twig',[
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/adminPanel/addArticle",name="addArticle")
     */
    public function addArticle(Request $request,FileUploader $fileUploader)
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class,$article);

        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                $data = $form->getData();
                $img = $data->getImg();
                    if ($pictureName = $fileUploader->upload($img)) {
                        $data->setImg($pictureName);
                    }
                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();

                return $this->redirectToRoute('adminPanel');
            }
        return $this->render('addArticle.html.twig',[
            'form' => $form->createView()
        ]);
    }


}