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

 #[Route('/{id}/valida', name: 'app_testa_t_validacion_valida', methods: ['GET'])]
    public function valida(TestaTvalidacion $testaTvalidacion,
                            TestaTtestamentoRepository $testaTtestamento,
                            TestaVtestavalidacionRepository $testaVtestavalidacionRepository): Response
    {
        $id_testamento = $testaTvalidacion->getIdTestamento();
        $testaTtestamento =  $testaTtestamento->find($id_testamento);
        $id_imagen = $testaTtestamento->getImagen()->getId();
//        var_dump($id_imagen);
        $validaciones = $testaVtestavalidacionRepository->findTestaImagen($id_imagen);
        return $this->render('testa_t_validacion/valida.html.twig', [
            'testaTvalidacion' => $testaTvalidacion,
            'validaciones' => $validaciones,
            'testamento' =>  $testaTtestamento,
        ]);
    }

 #[Route('/valida/submit', name: 'app_testa_t_validacion_submit', methods: ['POST'])]
    public function handleForm(Request $request,
                            EntityManagerInterface $entityManager): Response
    {
        $documento = $request->request->get('documento');
 //       var_dump($documento);
        $anno = $request->request->get('anno');
 //       var_dump($anno);
        $mes = $request->request->get('mes');
 //       var_dump($mes);
        $dia = $request->request->get('dia');
 //       var_dump($dia);
        $mancomunado = $request->request->get('mancomunado');
 //       var_dump($mancomunado);
        $ilegible = $request->request->get('ilegible');
 //       var_dump($ilegible);
        $protocolo = $request->request->get('protocolo');
 //       var_dump($protocolo);
        $folio = $request->request->get('folio');
 //       var_dump($folio);
        $poblacion = $request->request->get('poblacion');
 //       var_dump($poblacion);
        $notario = $request->request->get('notario');
 //       var_dump($notario);
        $imagen = $request->request->get('imagen');
 //       var_dump($imagen);

        $otorgantes = $request->request->all('otorgante');
//        var_dump($otorgantes);
        $testaTtestamento = new TestaTtestamento();
        $testaTtestamento->setTipoDoc($documento);
        $testaTtestamento->setAnno($anno);
        $testaTtestamento->setMes($mes);
        $testaTtestamento->setdia($dia);
        $testaTtestamento->setMancomunado($mancomunado);
        $testaTtestamento->setTextoilegible($ilegible);
        $testaTtestamento->setNumProtocolo($protocolo);
        $testaTtestamento->setNumFolio($folio);
        $pobla = $entityManager->getRepository(testaTpoblacion::class)->find($poblacion);
        $testaTtestamento->setPoblacion($pobla);
        $nota = $entityManager->getRepository(testaTnotario::class)->find($notario);
        $testaTtestamento->setNotario($nota);
        $imag = $entityManager->getRepository(testaTimagen::class)->find($imagen);
        $testaTtestamento->setImagen($imag);
        $testaTtestamento->setEstadovalidacion('M');
        $entityManager->persist($testaTtestamento);
        $entityManager->flush();        

        for($i=0; $i<count($otorgantes); $i++) {
        $testaTtestaotorgante = new TestaTtestaotorgante();
        $testaTtestaotorgante->setTestamento($testaTtestamento);
        $otor = $entityManager->getRepository(testaTotorgante::class)->find($otorgantes[$i]);
        $testaTtestaotorgante->setOtorgante($otor);
        $testaTtestaotorgante->setNumOrden($i+1);
        $entityManager->persist($testaTtestaotorgante);
        $entityManager->flush();        
        }

        // Lógica con el dato recibido, como guardarlo o mostrarlo
        return $this->render('testa_t_validacion/resultadoValidacion.html.twig', [
            'nuevo_testamento' =>  $testaTtestamento,
        ]);
    }

}
