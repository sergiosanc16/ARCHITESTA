<?php

namespace App\Controller;

use App\Entity\TestaTtestaotorgante;
use App\Entity\TestaVtestaotorgante;
use App\Form\TestaTtestaotorganteType;
use App\Repository\TestaTtestaotorganteRepository;
use App\Repository\TestaVtestaotorganteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/ttestaotorgante')]
final class TestaTtestaotorganteController extends AbstractController
{
    #[Route(name: 'app_testa_ttestaotorgante_index', methods: ['GET'])]
    public function index(TestaVtestaotorganteRepository $testaTtestaotorganteRepository): Response
    {
        return $this->render('testa_ttestaotorgante/index.html.twig', [
            'testa_ttestaotorgantes' => $testaTtestaotorganteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_ttestaotorgante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTtestaotorgante = new TestaTtestaotorgante();
        $form = $this->createForm(TestaTtestaotorganteType::class, $testaTtestaotorgante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTtestaotorgante);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_ttestaotorgante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_ttestaotorgante/new.html.twig', [
            'testa_ttestaotorgante' => $testaTtestaotorgante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_ttestaotorgante_show', methods: ['GET'])]
    public function show(TestaTtestaotorgante $testaTtestaotorgante): Response
    {

        return $this->render('testa_ttestaotorgante/show.html.twig', [
            'testa_ttestaotorgante' => $testaTtestaotorgante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_ttestaotorgante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTtestaotorgante $testaTtestaotorgante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTtestaotorganteType::class, $testaTtestaotorgante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_ttestaotorgante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_ttestaotorgante/edit.html.twig', [
            'testa_ttestaotorgante' => $testaTtestaotorgante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_ttestaotorgante_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTtestaotorgante $testaTtestaotorgante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTtestaotorgante->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTtestaotorgante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_ttestaotorgante_index', [], Response::HTTP_SEE_OTHER);
    }
}
