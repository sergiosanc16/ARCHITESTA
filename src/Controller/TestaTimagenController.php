<?php

namespace App\Controller;

use App\Entity\TestaTimagen;
use App\Entity\TestaVimagen;
use App\Form\TestaTimagenType;
use App\Repository\TestaTimagenRepository;
use App\Repository\TestaVimagenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/timagen')]
final class TestaTimagenController extends AbstractController
{
    #[Route(name: 'app_testa_timagen_index', methods: ['GET'])]
    public function index(TestaVimagenRepository $testaVimagenRepository): Response
    {
        return $this->render('testa_timagen/index.html.twig', [
            'testa_timagens' => $testaVimagenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_testa_timagen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTimagen = new TestaTimagen();
        $form = $this->createForm(TestaTimagenType::class, $testaTimagen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTimagen);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_timagen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_timagen/new.html.twig', [
            'testa_timagen' => $testaTimagen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_timagen_show', methods: ['GET'])]
    public function show(TestaTimagen $testaTimagen): Response
    {
        return $this->render('testa_timagen/show.html.twig', [
            'testa_timagen' => $testaTimagen,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_timagen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTimagen $testaTimagen, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTimagenType::class, $testaTimagen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_timagen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_timagen/edit.html.twig', [
            'testa_timagen' => $testaTimagen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_timagen_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTimagen $testaTimagen, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTimagen->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTimagen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_timagen_index', [], Response::HTTP_SEE_OTHER);
    }
}
