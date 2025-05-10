<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TestaTraw;
use App\Service\CsvUploadService;
use App\Service\ValidacionTestamentos;
use App\Form\CsvUploadType;
use App\Form\ValidacionType;

final class CsvUploadController extends AbstractController
{
    
    #[Route('/csv/upload', name: 'app_csv_upload')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(CsvUploadType::class);
        $formVal = $this->createForm(ValidacionType::class);
        $form->handleRequest($request);
        $formVal->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $i = CsvUploadService::cargaCSV($form, $em);
            $this->addFlash('success', "Se importaron {$i} registros");
        }

        if ($formVal->isSubmitted() && $formVal->isValid()) {
            $mensjVal = ValidacionTestamentos::validacion($formVal, $em);
            $this->addFlash('success', $mensjVal);
        }
            
        return $this->render('csv_upload/index.html.twig', [
            'controller_name' => 'CsvUploadController',
            'form' => $form,
            'formVal' => $formVal
        ]);
    }
}