<?php

namespace App\Controller;

use App\Entity\TestaTtestamento;
use App\Form\TestaTtestamentoType;
use App\Repository\TestaTtestamentoRepository;
use App\Repository\TestaTtestaotorganteRepository;
use App\Repository\TestaVtestaotorganteRepository;
use App\Repository\TestaVtestavalidacionRepository;
use App\Repository\TestaTvalidacionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/testa/ttestamento')]
final class TestaTtestamentoController extends AbstractController
{
    #[Route(name: 'app_testa_ttestamento_index', methods: ['GET'])]
    public function index(TestaVtestavalidacionRepository $testaTtestamentoRepository): Response
    {
        return $this->render('testa_ttestamento/index.html.twig', [
            'testa_ttestamentos' => $testaTtestamentoRepository->findAll(),
        ]);
    }

    #[Route('/{id_imagen}/indeximagen',name: 'app_testa_ttestamento_imagen_index', methods: ['GET'])]
    public function indeximagen(TestaVtestavalidacionRepository $testaTtestamentoRepository, $id_imagen): Response
    {
        return $this->render('testa_ttestamento/index.html.twig', [
            'testa_ttestamentos' => $testaTtestamentoRepository->findTestaImagen($id_imagen),
        ]);
    }

    #[Route('/{id_notario}/indexnotario',name: 'app_testa_ttestamento_notario_index', methods: ['GET'])]
    public function indexnotario(TestaVtestavalidacionRepository $testaTtestamentoRepository, $id_notario): Response
    {
        return $this->render('testa_ttestamento/index.html.twig', [
            'testa_ttestamentos' => $testaTtestamentoRepository->findTestaNotario($id_notario),
        ]);
    }

    #[Route('/otorgante/{id_otorgante}/indexotorgante',name: 'app_testa_ttestamento_otorgante_index', methods: ['GET'])]
    public function indexotorgante(TestaVtestavalidacionRepository $testaVtestaotorganteRepository, $id_otorgante): Response
    {
        return $this->render('testa_ttestamento/index.html.twig', [
            'testa_ttestamentos' => $testaVtestaotorganteRepository->findByIdOtorgante($id_otorgante),
        ]);
    }


    #[Route('/new', name: 'app_testa_ttestamento_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $testaTtestamento = new TestaTtestamento();
        $form = $this->createForm(TestaTtestamentoType::class, $testaTtestamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($testaTtestamento);
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_ttestamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_ttestamento/new.html.twig', [
            'testa_ttestamento' => $testaTtestamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_testa_ttestamento_show', methods: ['GET'])]
    public function show(TestaTtestamento $testaTtestamento, 
                         TestaTtestaotorganteRepository $TestaTtestaotorganteRepository,
                         TestaTvalidacionRepository $TestaTvalidacionRepository,
                            $id): Response
    {
        $otorgantes = $TestaTtestaotorganteRepository->OtorgantesTestamento($id);
        $validaciones = $TestaTvalidacionRepository->findByIdtestamento($id);
        return $this->render('testa_ttestamento/show.html.twig', [
            'testa_ttestamento' => $testaTtestamento,
            'otorgantes'        => $otorgantes,
            'validaciones'      => $validaciones,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_testa_ttestamento_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TestaTtestamento $testaTtestamento, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TestaTtestamentoType::class, $testaTtestamento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_testa_ttestamento_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('testa_ttestamento/edit.html.twig', [
            'testa_ttestamento' => $testaTtestamento,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_testa_ttestamento_delete', methods: ['POST'])]
    public function delete(Request $request, TestaTtestamento $testaTtestamento, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$testaTtestamento->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($testaTtestamento);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_testa_ttestamento_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/ajax', name: 'testamento_ajax')]
    public function datatable(Request $request, TestaVtestavalidacionRepository $testaTtestamentoRepository): JsonResponse
    {
        $start = $request->query->getInt('start');
        $length = $request->query->getInt('length');

        $testamentos = $testaTtestamentoRepository->findAjax($start, $length);
        $test_length = count($testamentos);
        $total       = $testaTtestamentoRepository->countTotal();

            $data = [];
            foreach ($testamentos as $t) {
                $fila = [
                    $t->getId(),
                    $t->getEstadoValidacion() == 'M'
                        ? '<img width="30" src="/img/estrella.png">'            // estado
                        : $t->getEstadoValidacion(),
                    $t->getAnno(),
                    $t->getMes(),
                    $t->getDia(),
                    $t->isMancomunado() ? 'Sí' : 'No',
                    $t->isTextoilegible() ? 'Sí' : 'No',
                    $t->getNumProtocolo(),
                    $t->getNombre().' '.$t->getApellido1().' '.$t->getApellido2(),
                    $t->getNotario() ?: '',
                    $t->getPoblacion() ?: '',
                    $t->getNumValidacion(),
                    $t->gettipo_doc(),
                    file_exists($this->getParameter('kernel.project_dir').'/public/img/fichas/'.$t->getImagen())
                        ? "<a href='/img/fichas/{$t->getImagen()}'>{$t->getImagen()}</a>"
                        : $t->getImagen(),
                    // acciones
                    "<a href='/testamento/{$t->getId()}'><img width='30' src='/img/mostrar.png'></a>"
                    .($this->isGranted('ROLE_ADMIN')
                        ? " <a href='/testamento/{$t->getId()}/edit'><img width='30' src='/img/editar.png'></a>"
                        : '')
                ];
                
                $data[] = array_values($fila);
            }

        $json = [
            'draw' => intval($request->query->get('draw')),
            'recordsTotal' => intval($total),
            'recordsFiltered' => $total,
            'data' => $data
        ];

        return new JsonResponse($json);
    }

}