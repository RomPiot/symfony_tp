<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="post")
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/post/{id}", name="post_show")
     */
    public function show($id, PostRepository $postRepository)
    {
        $post = $postRepository->find($id);
        $comments = $post->getComments();


        return $this->render('post/show.html.twig', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}
