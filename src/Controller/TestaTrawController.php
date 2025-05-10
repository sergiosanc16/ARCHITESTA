<?php

namespace App\Controller;

use App\Entity\TestaTraw;
use App\Form\TestaTrawType;
use App\Repository\TestaTrawRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/traw')]
final class TestaTrawController extends AbstractController
{
    #[Route(name: 'app_testa_traw_index', methods: ['GET'])]
    public function index(TestaTrawRepository $testaTrawRepository): Response
    {
        return $this->render('testa_traw/index.html.twig', [
            'testa_traws' => $testaTrawRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_traw_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTraw = new TestaTraw();
        $form = $this->createForm(TestaTrawType::class, $testaTraw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTraw);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_traw_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_traw/new.html.twig', [
            'testa_traw' => $testaTraw,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_traw_show', methods: ['GET'])]
    public function show(TestaTraw $testaTraw): Response
    {
        return $this->render('testa_traw/show.html.twig', [
            'testa_traw' => $testaTraw,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_traw_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTraw $testaTraw, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTrawType::class, $testaTraw);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_traw_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_traw/edit.html.twig', [
            'testa_traw' => $testaTraw,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_traw_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTraw $testaTraw, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTraw->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTraw);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_traw_index', [], Response::HTTP_SEE_OTHER);
    }
}
