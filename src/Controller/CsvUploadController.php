<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Address;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

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
            
            $registros = $csv->fetch();
            
            $lote = 20;
            $i = 0;
            
            foreach ($registros as $row) {
                $entity = new TestaTraw();
                
                $entity->setid($row['nombre'] ?? null);
                $entity->setEmail($row['email'] ?? null);
                $entity->setFecha(new \DateTime($row['fecha'] ?? 'now'));
                
                $em->persist($entity);
                
                if (($i % $lote) === 0) {
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
