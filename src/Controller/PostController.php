<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/post/add", name="post_add")
     */
	public function add()
    {
		$post = new Post();
		// $post->setAuthor()

        $form = $this->createFormBuilder($post)
            ->add('title')
            ->add('content')
            ->add('save', SubmitType::class, ['label' => 'Créer'])
            ->getForm();

        return $this->render('post/add.html.twig', [
            'form' => $form->createView()
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
