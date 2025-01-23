<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{
    #[Route('/posts', name: 'app_posts', methods: ['GET'])]
    public function index(PostRepository $pr, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $pr->findAll(),
            $request->query->getInt('page', 1), /* page number */
            18 /* limit per page */
        );

        return $this->render('post/index.html.twig', [
            'posts' => $pagination,

        ]);
    }

    #[Route('/post/{ref}', name: 'app_post', methods: ['GET']),]
    public function show(PostRepository $pr, string $ref): Response
    {
        $post = $pr->findOneBy(['ref' => $ref]);
        return $this->render('post/show.html.twig', [
            "post" => $post,
            "title" => $post->getTitle(),
        ]);
    }


    // #[Route('/trip/{ref}', name: 'app_trip', methods: ['GET'])]
    // public function show(TripRepository $tr, string $ref): Response
    // {
    //     $trip = $tr->findOneBy(['ref' => $ref]);
    //     return $this->render('trip/show.html.twig', [
    //         'trip' => $trip,
    //         'title' => $trip->getTitle(),
    //         'descrition' => $trip->getDescription(),
    //     ]);
    // }
}
