<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Address;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\SyntaxError;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\TestaTraw;
use App\Form\CsvUploadType;

final class CsvUploadController extends AbstractController
{
    
    #[Route('/csv/upload', name: 'app_csv_upload')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(CsvUploadType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $uploadedFile = $form->get('csv_file')->getData();

            $reader = Reader::createFromPath($uploadedFile->getPathname(), 'r');
            $reader->setDelimiter(',');
            $reader->setEnclosure('"');
            $reader->setEscape('\\');
            $reader->setHeaderOffset(0); // Indicar que la primera línea es la cabecera
            
            $registros = $reader->getRecords();
           
            $lote = 20;
            $i = 0;

            foreach ($registros as $indice => $registro) {

                $raw = new TestaTraw();

                $raw->setClassificationId($registro['classification_id']);

                $tareas = $registro['annotations'];

                $datosTareas = json_decode($tareas, true);
                dump($datosTareas);
                if ($datosTareas) {
                    //$primeraTarea = $datosTareas['0'];
                    //$T0 = $primeraTarea['value'];
                    
                    //$value = $datosTareas['value'] ;

                    $fecha = $datosTareas['0']['value']['0']['value'];

                    dump($taskId);
                    dump($value);
                
                    switch ($taskId) {
                        case 'T0':
                            $datosFecha = json_decode($value, true);
                            $fechaId = $datosFecha['task'];
                            $fecha = $datosFecha['value'];
                
                            switch ($fechaId) {
                                case 'T1':
                                    $raw->setYear((int) $fecha);
                                    break;
                                case 'T2':
                                    $raw->setMonth($this->normalizeMonth($fecha));
                                    break;
                                case 'T3':
                                    $raw->setDay((int) $fecha);
                                    break;
                            }
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
            $this->addFlash('success', "Se importaron {$i} registros");
        }
            
        return $this->render('csv_upload/index.html.twig', [
            'controller_name' => 'CsvUploadController',
            'form' => $form,
        ]);
    }
}