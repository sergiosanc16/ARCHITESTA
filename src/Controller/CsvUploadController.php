<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use League\Csv\Reader;
use League\Csv\Statement;

final class CsvUploadController extends AbstractController
{
    #[Route('/csv/upload', name: 'app_csv_upload')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $uploadedFile = $request->files->get('csv_file');
            
            if (!$uploadedFile || $uploadedFile->getClientOriginalExtension() !== 'csv') {
                $this->addFlash('error', 'Por favor sube un archivo CSV válido');
                return $this->redirectToRoute('app_csv_import');
            }

            // Configuración de league/csv
            $csv = Reader::createFromPath($uploadedFile->getPathname(), 'r');
            $csv->setHeaderOffset(0); 
            
            $records = (new Statement())->process($csv);
            
            $batchSize = 20;
            $i = 0;
            
            foreach ($records as $record) {
                $entity = new TuEntidad();
                
                $entity->setNombre($record['nombre'] ?? null);
                $entity->setEmail($record['email'] ?? null);
                $entity->setFecha(new \DateTime($record['fecha'] ?? 'now'));
                
                $em->persist($entity);
                
                if (($i % $batchSize) === 0) {
                    $em->flush();
                    $em->clear();
                }
                $i++;
            }
            
            $em->flush();
            $em->clear();
            
            $this->addFlash('success', "Se importaron {$i} registros");
            return $this->redirectToRoute('app_csv_import');
        }
        return $this->render('csv_upload/index.html.twig', [
            'controller_name' => 'CsvUploadController',
        ]);
    }
}
