<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
	//Add constructor and inject EntityManagerInterface
	public function __construct(
		private readonly EntityManagerInterface $entityManager
	) {
	}
    #[Route('/todo', name: 'app_todo')]
    public function index(Request $request): Response
    {
        //Create form TodoType with Todo entity
        $form = $this->createForm(TodoType::class, new Todo());

		//Handle request from form submission and persist data to database
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			//Get data from form
			$todo = $form->getData();
			//Set created_at field to current datetime
			$todo->setCreatedAt(new \DateTimeImmutable());

			//Persist data to database
			$this->entityManager->persist($todo);
			$this->entityManager->flush();
			//Redirect to homepage
			return $this->redirectToRoute('app_todo');
		}

		//Get all todos from database
		$todos = $this->entityManager->getRepository(Todo::class)->findAll();

        return $this->render('todo/index.html.twig', [
			'todos' => $todos,
            'form' => $form->createView()
        ]);
    }
}
