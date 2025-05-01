<?php

namespace App\Controller;

use App\Entity\TestaTparentesco;
use App\Form\TestaTparentescoType;
use App\Repository\TestaTparentescoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/tparentesco')]
final class TestaTparentescoController extends AbstractController
{
    #[Route(name: 'app_testa_tparentesco_index', methods: ['GET'])]
    public function index(TestaTparentescoRepository $testaTparentescoRepository): Response
    {
        return $this->render('testa_tparentesco/index.html.twig', [
            'testa_tparentescos' => $testaTparentescoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_tparentesco_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTparentesco = new TestaTparentesco();
        $form = $this->createForm(TestaTparentescoType::class, $testaTparentesco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTparentesco);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_tparentesco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_tparentesco/new.html.twig', [
            'testa_tparentesco' => $testaTparentesco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_tparentesco_show', methods: ['GET'])]
    public function show(TestaTparentesco $testaTparentesco): Response
    {
        return $this->render('testa_tparentesco/show.html.twig', [
            'testa_tparentesco' => $testaTparentesco,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_tparentesco_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTparentesco $testaTparentesco, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTparentescoType::class, $testaTparentesco);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_tparentesco_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_tparentesco/edit.html.twig', [
            'testa_tparentesco' => $testaTparentesco,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_tparentesco_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTparentesco $testaTparentesco, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTparentesco->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTparentesco);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_tparentesco_index', [], Response::HTTP_SEE_OTHER);
    }
}
