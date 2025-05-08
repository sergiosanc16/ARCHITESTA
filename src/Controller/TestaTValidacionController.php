<?php

namespace App\Controller;

use App\Entity\TestaTValidacion;
use App\Form\TestaTValidacionType;
use App\Repository\TestaTValidacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/t/validacion')]
final class TestaTValidacionController extends AbstractController
{
    #[Route(name: 'app_testa_t_validacion_index', methods: ['GET'])]
    public function index(TestaTValidacionRepository $testaTValidacionRepository): Response
    {
        return $this->render('testa_t_validacion/index.html.twig', [
            'testa_t_validacions' => $testaTValidacionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_t_validacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTValidacion = new TestaTValidacion();
        $form = $this->createForm(TestaTValidacionType::class, $testaTValidacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTValidacion);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_t_validacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_t_validacion/new.html.twig', [
            'testa_t_validacion' => $testaTValidacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_t_validacion_show', methods: ['GET'])]
    public function show(TestaTValidacion $testaTValidacion): Response
    {
        return $this->render('testa_t_validacion/show.html.twig', [
            'testa_t_validacion' => $testaTValidacion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_t_validacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTValidacion $testaTValidacion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTValidacionType::class, $testaTValidacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_t_validacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_t_validacion/edit.html.twig', [
            'testa_t_validacion' => $testaTValidacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_t_validacion_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTValidacion $testaTValidacion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTValidacion->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTValidacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_t_validacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
