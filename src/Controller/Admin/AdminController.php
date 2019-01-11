<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 23.12.18
 * Time: 14:00
 */

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Contacts;
use App\Form\ArticlesType;
use App\Model\UpdateModel;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $repoOrders = $this->getDoctrine()->getRepository(Contacts::class);
        $orders = $repoOrders->findBy([],['id' =>'DESC']);

        return $this->render('admin/showOrder.html.twig',[
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/adminPanel/editPage",name="editPage")
     */
    public function showArticles()
    {
        $repoArticles = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repoArticles->findBy([],['id' =>'DESC']);

        return $this->render('admin/adminPanel.html.twig',[
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

                return $this->redirectToRoute('editPage');
            }
        return $this->render('admin/addArticle.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/adminPanel/deleteArticle/{slug}",name="deleteArticle")
     */
    public function deleteArticle($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Articles::class)->findOneBy(['slug' => $slug]);

        unlink($this->getParameter('app.uploads_dir').$article->getImg());
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute('editPage');
    }

    /**
     * @Route("/adminPanel/editArticle/{slug}",name="editArticle")
     */
    public function editArticle(Request $request,FileUploader $fileUploader,Articles $articles)
    {

        $updateModel = new UpdateModel();
        $updateModel->setTitle($articles->getTitle());
        $updateModel->setText($articles->getText());
        $updateModel->setSlug($articles->getSlug());
        $updateModel->setDescription($articles->getDescription());

        $form = $this->createForm(ArticlesType::class,$updateModel);
        $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();
                $img = $data->getImg();
                if($img instanceof UploadedFile) {
                    if ($pictureName = $fileUploader->upload($img)){
                            unlink($this->getParameter('app.uploads_dir').$articles->getImg());
                            $articles->setImg($pictureName);
                    }
                }
                $articles->setTitle($data->getTitle());
                $articles->setText($data->getText());
                $articles->setSlug($data->getSlug());
                $articles->setDescription($data->getDescription());
                $articles->setUpdatedAt(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirectToRoute('editPage');
            }
            return $this->render('admin/editArticle.html.twig',[
               'form' => $form->createView(),
                'article' => $articles
            ]);

    }

}