<?php

namespace App\Controller;

use App\Entity\TestaTpoblacion;
use App\Form\TestaTpoblacionType;
use App\Repository\TestaTpoblacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/tpoblacion')]
final class TestaTpoblacionController extends AbstractController
{
    #[Route(name: 'app_testa_tpoblacion_index', methods: ['GET'])]
    public function index(TestaTpoblacionRepository $testaTpoblacionRepository): Response
    {
        return $this->render('testa_tpoblacion/index.html.twig', [
            'testa_tpoblacions' => $testaTpoblacionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_tpoblacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTpoblacion = new TestaTpoblacion();
        $form = $this->createForm(TestaTpoblacionType::class, $testaTpoblacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTpoblacion);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_tpoblacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_tpoblacion/new.html.twig', [
            'testa_tpoblacion' => $testaTpoblacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_tpoblacion_show', methods: ['GET'])]
    public function show(TestaTpoblacion $testaTpoblacion): Response
    {
        return $this->render('testa_tpoblacion/show.html.twig', [
            'testa_tpoblacion' => $testaTpoblacion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_tpoblacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTpoblacion $testaTpoblacion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTpoblacionType::class, $testaTpoblacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_tpoblacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_tpoblacion/edit.html.twig', [
            'testa_tpoblacion' => $testaTpoblacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_tpoblacion_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTpoblacion $testaTpoblacion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTpoblacion->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTpoblacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_tpoblacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
