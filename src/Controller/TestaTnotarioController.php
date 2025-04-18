<?php

namespace App\Controller;

use App\Entity\TestaTnotario;
use App\Form\TestaTnotarioType;
use App\Repository\TestaTnotarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/tnotario')]
final class TestaTnotarioController extends AbstractController
{
    #[Route(name: 'app_testa_tnotario_index', methods: ['GET'])]
    public function index(TestaTnotarioRepository $testaTnotarioRepository): Response
    {
        return $this->render('testa_tnotario/index.html.twig', [
            'testa_tnotarios' => $testaTnotarioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_tnotario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTnotario = new TestaTnotario();
        $form = $this->createForm(TestaTnotarioType::class, $testaTnotario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTnotario);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_tnotario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_tnotario/new.html.twig', [
            'testa_tnotario' => $testaTnotario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_tnotario_show', methods: ['GET'])]
    public function show(TestaTnotario $testaTnotario): Response
    {
        return $this->render('testa_tnotario/show.html.twig', [
            'testa_tnotario' => $testaTnotario,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_tnotario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTnotario $testaTnotario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTnotarioType::class, $testaTnotario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_tnotario_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_tnotario/edit.html.twig', [
            'testa_tnotario' => $testaTnotario,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_tnotario_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTnotario $testaTnotario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTnotario->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTnotario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_tnotario_index', [], Response::HTTP_SEE_OTHER);
    }
}
