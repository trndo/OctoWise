<?php
/**
 * Created by PhpStorm.
 * User: vel-vet
 * Date: 10.01.19
 * Time: 15:07
 */

namespace App\Controller;


use App\Entity\Articles;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/blog",name="blog")
     */
    public function showAllArticles(Request $request,PaginatorInterface $paginator)
    {
        $repoArticles = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repoArticles->findBy([],['id' =>'DESC']);
        $pagination = $paginator->paginate($articles,
            $request->query->getInt('page',1),5);

        return $this->render('pages/blogPage.html.twig',[
//            'articles' => $articles,
            'pagination' => $pagination
        ]);
    }

    /**
     * @Route("/blog/article/{slug}",name="article")
     */
    public function showArticle($slug)
    {
        $repoArticles = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repoArticles->findOneBy(['slug'=>$slug]);

        return $this->render('pages/articlePage.html.twig',[
                'articles' => $articles
        ]);
    }
}