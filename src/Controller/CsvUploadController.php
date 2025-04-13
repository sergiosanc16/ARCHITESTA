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

                $datosTareas = json_decode($tareas, True);
                if ($datosTareas) {
                    //año
                    $raw->setYear((int) $datosTareas['0']['value']['0']['value']);
                    //mes
                    $raw->setMonth((int)$datosTareas['0']['value']['1']['value']);
                    //dia
                    $raw->setDay((int) $datosTareas['0']['value']['2']['value']);
                    //OtraPoblacion
                    if($datosTareas['1']['value']=='Yes'){
                        $raw->setOtherPopulation(True);
                        $raw->setPopulationName($datosTareas['2']['value']);
                        //nombre otorgante
                        $raw->setGrantorSurname1($datosTareas['3']['value']['0']['value']);
                        $raw->setGratorSurname2($datosTareas['3']['value']['1']['value']);
                        $raw->setGrantorName($datosTareas['3']['value']['2']['value']);
                        if($datosTareas['4']['value']=='Yes'){
                            $raw->setOfficeMentioned(True);
                            $raw->setGrantorOffice($datosTareas['5']['value']);
                            if($datosTareas['6']['value']=='Yes'){
                                $raw->setRelationshipMentioned(True);
                                $raw->setGrantorRelationship($datosTareas['7']['value']);
                                $raw->setNotaryName($datosTareas['8']['value']);
                                $raw->setDocumentType($datosTareas['9']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['10']['value']);
                                $raw->setFolioNumber((int)$datosTareas['11']['value']);
                            } else {
                                $raw->setNotaryName($datosTareas['7']['value']);
                                $raw->setDocumentType($datosTareas['8']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['9']['value']);
                                $raw->setFolioNumber((int)$datosTareas['10']['value']);
                                }
                        } else {
                            if($datosTareas['5']['value']=='Yes'){
                                $raw->setRelationshipMentioned(True);
                                $raw->setGrantorRelationship($datosTareas['6']['value']);
                                $raw->setNotaryName($datosTareas['7']['value']);
                                $raw->setDocumentType($datosTareas['8']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['9']['value']);
                                $raw->setFolioNumber((int)$datosTareas['10']['value']);
                            } else {
                                $raw->setRelationshipMentioned(False);
                                $raw->setNotaryName($datosTareas['6']['value']);
                                $raw->setDocumentType($datosTareas['7']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['8']['value']);
                                $raw->setFolioNumber((int)$datosTareas['9']['value']);
                            }
                        }
                    } else {
                        $raw->setOtherPopulation(False);
                        $raw->setPopulationName('Ninguna');

                        $raw->setGrantorSurname1($datosTareas['2']['value']['0']['value']);
                        $raw->setGratorSurname2($datosTareas['2']['value']['1']['value']);
                        $raw->setGrantorName($datosTareas['2']['value']['2']['value']);
                        if($datosTareas['3']['value']=='Yes'){
                            $raw->setOfficeMentioned(True);
                            $raw->setGrantorOffice($datosTareas['4']['value']);
                            if($datosTareas['5']['value']=='Yes'){
                                $raw->setRelationshipMentioned(True);
                                $raw->setGrantorRelationship($datosTareas['6']['value']);
                                $raw->setNotaryName($datosTareas['7']['value']);
                                $raw->setDocumentType($datosTareas['8']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['9']['value']);
                                $raw->setFolioNumber((int)$datosTareas['10']['value']);
                            } else {
                                $raw->setRelationshipMentioned(False);
                                $raw->setNotaryName($datosTareas['6']['value']);
                                $raw->setDocumentType($datosTareas['7']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['8']['value']);
                                $raw->setFolioNumber((int)$datosTareas['9']['value']);
                            }
                        } else {
                            if($datosTareas['4']['value']=='Yes'){
                                $raw->setRelationshipMentioned(True);
                                $raw->setGrantorRelationship($datosTareas['5']['value']);
                                $raw->setNotaryName($datosTareas['6']['value']);
                                $raw->setDocumentType($datosTareas['7']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['8']['value']);
                                $raw->setFolioNumber((int)$datosTareas['9']['value']);
                            } else {
                                $raw->setNotaryName($datosTareas['5']['value']);
                                $raw->setDocumentType($datosTareas['6']['value']['0']['label']);
                                $raw->setProtocolNumber($datosTareas['7']['value']);
                                $raw->setFolioNumber((int)$datosTareas['8']['value']);
                            }
                        }
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