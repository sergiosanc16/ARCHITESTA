<?php

namespace App\Controller;

use App\Entity\TestaTotorgante;
use App\Form\TestaTotorganteType;
use App\Repository\TestaTotorganteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/totorgante')]
final class TestaTotorganteController extends AbstractController
{
    #[Route(name: 'app_testa_totorgante_index', methods: ['GET'])]
    public function index(TestaTotorganteRepository $testaTotorganteRepository): Response
    {
        return $this->render('testa_totorgante/index.html.twig', [
            'testa_totorgantes' => $testaTotorganteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_totorgante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTotorgante = new TestaTotorgante();
        $form = $this->createForm(TestaTotorganteType::class, $testaTotorgante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTotorgante);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_totorgante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_totorgante/new.html.twig', [
            'testa_totorgante' => $testaTotorgante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_totorgante_show', methods: ['GET'])]
    public function show(TestaTotorgante $testaTotorgante): Response
    {
        return $this->render('testa_totorgante/show.html.twig', [
            'testa_totorgante' => $testaTotorgante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_totorgante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTotorgante $testaTotorgante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTotorganteType::class, $testaTotorgante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_totorgante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_totorgante/edit.html.twig', [
            'testa_totorgante' => $testaTotorgante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_totorgante_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTotorgante $testaTotorgante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTotorgante->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTotorgante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_totorgante_index', [], Response::HTTP_SEE_OTHER);
    }
}
