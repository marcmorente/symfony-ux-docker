<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
use App\Repository\TodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    public function __construct(
        private readonly TodoRepository $todoRepository
    ) {
    }

    #[Route('/todo', name: 'app_todo')]
    public function index(): Response
    {
        //Get all todos from database
        $todos = $this->todoRepository->findAll();

        return $this->render('todo/index.html.twig', [
            'todos' => $todos
        ]);
    }

    #[Route('/todo/form', name: 'app_todo_form')]
    public function form(Request $request): Response
    {
        $todoEntity = new Todo();
        $form = $this->createForm(TodoType::class, $todoEntity);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $todoEntity = $form->getData();
            $todoEntity->setCreatedAt(new \DateTimeImmutable());
            $this->todoRepository->save($todoEntity, true);
            return $this->redirectToRoute('app_todo');
        }

        return $this->render('components/form.html.twig', [
            'form' => $form->createView(),
            'formTarget' => $request->headers->get('Turbo-Frame', '_top')
        ]);
    }
}
