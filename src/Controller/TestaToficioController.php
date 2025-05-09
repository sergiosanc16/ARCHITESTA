<?php

namespace App\Controller;

use App\Entity\TestaToficio;
use App\Form\TestaToficioType;
use App\Repository\TestaToficioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/toficio')]
final class TestaToficioController extends AbstractController
{
    #[Route(name: 'app_testa_toficio_index', methods: ['GET'])]
    public function index(TestaToficioRepository $testaToficioRepository): Response
    {
        return $this->render('testa_toficio/index.html.twig', [
            'testa_toficios' => $testaToficioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_toficio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaToficio = new TestaToficio();
        $form = $this->createForm(TestaToficioType::class, $testaToficio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaToficio);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_toficio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_toficio/new.html.twig', [
            'testa_toficio' => $testaToficio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_toficio_show', methods: ['GET'])]
    public function show(TestaToficio $testaToficio): Response
    {
        return $this->render('testa_toficio/show.html.twig', [
            'testa_toficio' => $testaToficio,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_toficio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaToficio $testaToficio, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaToficioType::class, $testaToficio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_toficio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_toficio/edit.html.twig', [
            'testa_toficio' => $testaToficio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_toficio_delete', methods: ['POST'])]
    public function delete(Request $request, TestaToficio $testaToficio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaToficio->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaToficio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_toficio_index', [], Response::HTTP_SEE_OTHER);
    }
}
