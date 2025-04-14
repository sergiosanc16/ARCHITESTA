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

                $datosTareas = json_decode($registro['annotations'], True);
                if ($datosTareas) {
                    //año
                    $raw->setYear((int) $datosTareas['0']['value']['0']['value']);
                    //mes
                    $raw->setMonth((int)$datosTareas['0']['value']['1']['value']);
                    //dia
                    $raw->setDay((int) $datosTareas['0']['value']['2']['value']);
                    //OtraPoblacion
                    for($i=1;$i<count($datosTareas);$i++){
                        $task = $datosTareas[$i]['task'];
                        switch ($task){
                            case 'T4':
                                if($datosTareas[$i]['value']=='Yes'){
                                    $raw->setOtherPopulation(True);
                                    $raw->setPopulationName($datosTareas[$i++]['value']);
                                } else {
                                    $raw->setOtherPopulation(False);
                                    $raw->setPopulationName('Ninguna');
                                }
                                break;
                            case 'T6':
                                $raw->setGrantorSurname1($datosTareas[$i]['value']['0']['value']);
                                $raw->setGratorSurname2($datosTareas[$i]['value']['1']['value']);
                                $raw->setGrantorName($datosTareas[$i]['value']['2']['value']);
                                break;
                            case 'T10':
                                if($datosTareas[$i]['value']=='Yes'){
                                    $raw->setOfficeMentioned(True);
                                    $raw->setGrantorOffice($datosTareas[$i++]['value']);
                                } else {
                                    $raw->setOfficeMentioned(False);
                                    $raw->setGrantorOffice('Ninguna');
                                }
                                break;
                            case 'T12':
                                $raw->setNotaryName($datosTareas[$i]['value']);
                                break;
                            case 'T13':
                                $raw->setProtocolNumber((int)$datosTareas[$i]['value']);
                                break;
                            case 'T14':
                                $raw->setFolioNumber((int)$datosTareas[$i]['value']);
                                break;
                            case 'T15':
                                if($datosTareas[$i]['value']=='Yes'){
                                    $raw->setRelationshipMentioned(True);
                                    $raw->setGrantorRelationship($datosTareas[$i++]['value']);
                                } else {
                                    $raw->setRelationshipMentioned(False);
                                    $raw->setGrantorRelationship('Ninguna');
                                }
                                break;
                            case 'T17':
                                if($datosTareas[$i]['value']['0']['label'] =='Otros'){
                                    $raw->setDocumentType($datosTareas[$i++]['value']);
                                } else {
                                    $raw->setDocumentType($datosTareas[$i]['value']['0']['label']);
                                }
                                break;
                            case 'T20':
                                if($datosTareas[$i]['value']=='Yes'){
                                    $raw->setSecondGrantor(TRUE);
                                    $raw->setSecondGrantorName($datosTareas[$i++]['value']);
                                } else {
                                    $raw->setSecondGrantor(FALSE);
                                    $raw->setSecondGrantorName("Ningun@");
                                }
                                break;
                            case 'T22':
                                $raw->setNotaryName($datosTareas[$i]['value']);
                                break;
                        }
                    }
                    $datosFoto = json_decode($registro['subject_data'], True);
                    $idFoto = (int) $registro['subject_ids'];
                    $raw->setFilename($datosFoto[$idFoto]['Filename']);

                    dump($raw);
                        
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