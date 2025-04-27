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
use App\Form\CsvUploadType;

final class CsvUploadController extends AbstractController
{
    
    #[Route('/csv/upload', name: 'app_csv_upload')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(CsvUploadType::class);
        $form->handleRequest($request);
        dump($form->isValid());
        if ($form->isSubmitted() && $form->isValid()) {
            

            $i = CsvUploadService::cargaCSV($form, $em);

            $this->addFlash('success', "Se importaron {$i} registros");
        }
            
        return $this->render('csv_upload/index.html.twig', [
            'controller_name' => 'CsvUploadController',
            'form' => $form,
        ]);
    }
}