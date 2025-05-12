<?php

namespace App\Controller;

use App\Entity\TestaTvalidacion;
use App\Entity\TestaVtestavalidacion;
use App\Form\TestaTvalidacionType;
use App\Repository\TestaTvalidacionRepository;
use App\Repository\TestaVtestavalidacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/t/validacion')]
final class TestaTvalidacionController extends AbstractController
{
    #[Route(name: 'app_testa_t_validacion_index', methods: ['GET'])]
    public function index(TestaTvalidacionRepository $testaTvalidacionRepository): Response
    {
        return $this->render('testa_t_validacion/index.html.twig', [
            'testa_t_validacions' => $testaTvalidacionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_t_validacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTvalidacion = new TestaTvalidacion();
        $form = $this->createForm(TestaTvalidacionType::class, $testaTvalidacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTvalidacion);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_t_validacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_t_validacion/new.html.twig', [
            'testa_t_validacion' => $testaTvalidacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_t_validacion_show', methods: ['GET'])]
    public function show(TestaVtestavalidacion $testaTvalidacion): Response
    {
        return $this->render('testa_t_validacion/show.html.twig', [
            'testa_t_validacion' => $testaTvalidacion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_t_validacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTvalidacion $testaTvalidacion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTvalidacionType::class, $testaTvalidacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_t_validacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_t_validacion/edit.html.twig', [
            'testa_t_validacion' => $testaTvalidacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_t_validacion_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTvalidacion $testaTvalidacion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTvalidacion->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTvalidacion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_t_validacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
