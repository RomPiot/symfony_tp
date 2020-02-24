<?php

namespace App\Controller;


use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostController extends AbstractController
{
	/**
	 * @Route("/post", name="post")
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
	public function add(UserRepository $userRepository, Request $request, EntityManagerInterface $em)
	{
		$user = $userRepository->find(1);
		$post = new Post();
		$post->setAuthor($user);

		$form = $this->createFormBuilder($post)
			->add('title', TextType::class, ['label' => 'Titre'])
			->add('content', TextareaType::class, ['label' => 'Contenu'])
			->add('save', SubmitType::class, ['label' => 'Créer'])
			->getForm();
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			//            dd($post);
			$em->persist($post);
			$em->flush();

			return $this->redirectToRoute("post");
		}

		return $this->render('post/add.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/post/{id}", name="post_show")
	 */
	public function show($id, PostRepository $postRepository, UserRepository $userRepository, Request $request, EntityManagerInterface $em)
	{
		$post = $postRepository->find($id);
		$comments = $post->getComments();

		$user = $this->getUser();

		$comment = new Comment();
		$comment->setPost($post);
		$comment->setAuthor($user);

		$form = $this->createFormBuilder($comment)
			->add('content', TextareaType::class, ['label' => 'Ajouter un commentaire'])
			->add('save', SubmitType::class, ['label' => 'Envoyer'])
			->getForm();
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$em->persist($comment);
			$em->flush();

			return $this->redirectToRoute("post_show", ["id" => $id]);
		}


		return $this->render('post/show.html.twig', [
			'post' => $post,
			'comments' => $comments,
			'form' => $form->createView()
		]);
	}

    /**
     * @Route("/post/edit/{id}", name="post_edit")
     */
    public function edit($id, PostRepository $postRepository, UserRepository $userRepository, Request $request, EntityManagerInterface $em)
    {
        $user = $this->getUser();
        $post = $postRepository->find($id);

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class, ['label' => 'Titre'])
            ->add('content', TextareaType::class, ['label' => 'Contenu'])
            ->add('save', SubmitType::class, ['label' => 'Créer'])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute("post");
        }

        return $this->render('post/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
