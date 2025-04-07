<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Address;
use League\Csv\Reader;
use League\Csv\Statement;
use Doctrine\ORM\EntityManagerInterface;

final class CsvUploadController extends AbstractController
{
    #[Route('/csv/upload', name: 'app_csv_upload')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $i = 0;
        if ($request->isMethod('POST')) {
            $uploadedFile = $request->files->get('csv_file');

            // Configuración de league/csv
            $reader = Reader::createFromPath($uploadedFile->getPathname(), 'r');
            $reader->setHeaderOffset(0); 
                
            $registros = $reader->getRecords();
                
            $lote = 20;
                
            foreach ($registros as $registro) {
                $raw = new TestaTraw();

                $raw->setClassificationId($registro[0]);

                $tareas = $registro[count($registro)];
                $datosTareas = json_decode($tareas, true);
                if ($datosTareas) {
                    $taskId = $task['task'] ?? null;
                    $value = $task['value'] ?? null;
                
                    switch ($taskId) {
                        case 'T0':
                            foreach ($value as $subTask) {
                                $this->processTask($subTask, $raw);
                            }
                            break;
                        case 'T1':
                            $raw->setYear((int) $value);
                            break;
                        case 'T2':
                            $raw->setMonth($this->normalizeMonth($value));
                            break;
                        case 'T3':
                            $raw->setDay((int) $value);
                            break;
                        case 'T4':
                            $raw->setOtherPopulation($value === 'Yes');
                            break;
                        case 'T5':
                            if ($value) $raw->setPopulationName($value);
                            break;
                        case 'T6':
                            foreach ($value as $subTask) {
                                $this->processTask($subTask, $raw);
                            }
                            break;
                        case 'T7':
                            $raw->setGrantorSurname1($value);
                            break;
                        case 'T8':
                            $raw->setGrantorSurname2($value ?: null);
                            break;
                        case 'T9':
                            $raw->setGrantorName($value);
                            break;
                        case 'T10':
                            $raw->setOfficeMentioned($value === 'Yes');
                            break;
                        case 'T11':
                            if ($value) $raw->setGrantorOffice($value);
                            break;
                        case 'T12':
                            $this->parseNotary($value, $raw);
                            break;
                        case 'T13':
                            $raw->setProtocolNumber((int) $value);
                            break;
                        case 'T14':
                            $raw->setFolioNumber($this->parseFolio($value));
                            break;
                        case 'T15':
                            $raw->setRelationshipMentioned($value === 'Yes');
                            break;
                        case 'T16':
                            $raw->setGrantorRelationship($value);
                            break;
                        case 'T17':
                            $raw->setDocumentType($value[0]['label']);
                            break;
                        case 'T20':
                            $raw->setSecondGrantor($value === 'Yes');
                            break;
                    }
                        
                    $em->persist($raw);
                }
                    
                if (($i % $lote) === 0) {
                    $em->flush();
                    $em->clear();
                }
                $i++;
            }
                
            $em->flush();
            $em->clear();
        }
            
        $this->addFlash('success', "Se importaron {$i} registros");
        return $this->render('csv_upload/index.html.twig', [
            'controller_name' => 'CsvUploadController',
        ]);
    }
}