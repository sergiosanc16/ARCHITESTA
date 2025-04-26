<?php
namespace App\Service;

use Symfony\Component\Form\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Types\Types;
use App\Entity\TestaTraw;
use App\Entity\TestaTtestamento;
use App\Entity\TestaTimagen;
use App\Entity\TestaTnotario;
use App\Entity\TestaToficio;
use App\Entity\TestaTparentesco;
use App\Entity\TestaTpoblacion;
use App\Entity\TestaTotorgante;
use App\Entity\TestaTtestaotorgante;
use League\Csv\Reader;
use League\Csv\Statement;
use League\Csv\SyntaxError;

class CsvUploadService{

    public static function cargaCSV(Form $form, EntityManagerInterface $em): int
    {
        $uploadedFile = $form->get('csv_file')->getData();
        $tratamiento = file_get_contents($uploadedFile->getPathname());

        $tratamiento = preg_replace('/^"/', '', $tratamiento);
        $tratamiento = preg_replace('/";+;$/', '', $tratamiento);
        $tratamiento = preg_replace('/^((?:[^,]*,){5})([^,]*)(,)/', '$1"$2"$3', $tratamiento);
        $tratamiento = preg_replace('/"{4}/', '""', $tratamiento);
        $tratamiento = preg_replace('/,""(\{)/', ',"$1', $tratamiento); 
        $tratamiento = preg_replace('/(\})""(,)/', '$1"$2', $tratamiento);
        $tratamiento = preg_replace('/,""(\[)/', ',"$1', $tratamiento);
        $tratamiento = preg_replace('/(\])""(,)/', '$1"$2', $tratamiento);

        $csvTemp = fopen('php://temp', 'r+');
        fwrite($csvTemp, $tratamiento);
        rewind($csvTemp);

        $campos = fgetcsv($csvTemp,0, ',', '"');
        $campos = fgetcsv($csvTemp,0, ',', '"');
        dump($campos);

        $annotations = json_decode($annotationsJson, true);

        dump($annotations);

        //dump($registros);
           
        $lote = 20;
        $i = 0;
        $segOtor=FALSE;
        $raw = new TestaTraw();
        $ilegible = FALSE;

        foreach ($registros as $indice => $registro) {

            $raw = new TestaTraw();
            $ilegible = FALSE;
            $raw->setClassificationId($registro['classification_id']);
            $datosTareas = json_decode($registro['annotations'], true);
            dump($registro);

            if ($datosTareas) {
                //año
                $raw->setYear((int) $datosTareas['0']['value']['0']['value']);
                //mes
                $raw->setMonth($datosTareas['0']['value']['1']['value']);
                //dia
                $raw->setDay((int) $datosTareas['0']['value']['2']['value']);
                //OtraPoblacion
                for($i=1;$i<count($datosTareas);$i++){
                    $task = $datosTareas[$i]['task'];
                    switch ($task){
                        case 'T4':
                            if($datosTareas[$i]['value']=='Yes'){
                                $raw->setOtherPopulation(True);
                                $raw->setPopulationName($datosTareas[++$i]['value']);
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
                                $raw->setGrantorOffice($datosTareas[++$i]['value']);
                            } else {
                                $raw->setOfficeMentioned(False);
                                $raw->setGrantorOffice('Ninguna');
                            }
                            break;
                        case 'T12':
                            if($datosTareas[$i]['value']){
                                $raw->setNotaryName($datosTareas[$i]['value']);
                            }
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
                                $raw->setGrantorRelationship($datosTareas[++$i]['value']);
                            } else {
                                $raw->setRelationshipMentioned(False);
                                $raw->setGrantorRelationship('Ninguna');
                            }
                            break;
                        case 'T17':
                            if(array_key_exists('label',$datosTareas[$i]['value']['0'])){
                                if($datosTareas[$i]['value']['0']['label'] =='Otros'){
                                    $raw->setDocumentType($datosTareas[++$i]['value']);
                                } else {
                                    $raw->setDocumentType($datosTareas[$i]['value']['0']['label']);
                                }
                            }else{
                                $raw->setDocumentType('Ninguno');
                            }
                            break;
                        case 'T20':
                            $segOtor=TRUE;
                            if($datosTareas[$i]['value']=='Yes'){
                                $raw->setSecondGrantor(TRUE);
                                if(gettype($datosTareas[++$i]['value'])=='array'){
                                    $raw->setSecondGrantorName($datosTareas[$i]['value']['2']['value']);
                                }else{
                                    $raw->setSecondGrantorName($datosTareas[$i]['value']);
                                }
                                
                            } else {
                                $raw->setSecondGrantor(FALSE);
                                $raw->setSecondGrantorName("Ningun@");
                            }
                            break;
                        case 'T22':
                            if($datosTareas[$i]['value']!=null){
                                $raw->setNotaryName($datosTareas[$i]['value']);
                            }
                            break;
                        case 'T27':
                            if($datosTareas[$i]['value']=='Yes'){
                                $ilegible = TRUE;
                            } else {
                                $ilegible = FALSE;
                            }
                    }
                }
                if($raw->getYear()==null){
                    $raw->setYear(0);
                }
                if($raw->getMonth()==null){
                    $raw->setMonth('Ninguno');
                }
                if($raw->getDay()==null){
                    $raw->setDay(0);
                }
                if(!$raw->isOtherPopulation()==null){
                    $raw->setOtherPopulation(FALSE);
                }
                if($raw->getPopulationName()==null){
                    $raw->setPopulationName('Ninguna');
                }
                if($raw->getGrantorName()==null){
                    $raw->setPopulationName('Ninguna');
                }
                if($raw->getGrantorSurname1()==null){
                    $raw->setGrantorSurname1('Ninguno');
                }
                if($raw->getGratorSurname2()==null){
                    $raw->setGratorSurname2('Ninguno');
                }
                if($raw->isOfficeMentioned()==null){
                    $raw->setOfficeMentioned(FALSE);
                }
                if($raw->getGrantorOffice()==null){
                    $raw->setGrantorOffice('Ninguno');
                }
                if($raw->isRelationshipMentioned()==null){
                    $raw->setRelationshipMentioned(FALSE);
                }
                if($raw->getGrantorRelationship()==null){
                    $raw->setGrantorRelationship('Ninguno');
                }
                if($raw->getDocumentType()==null){
                    $raw->setDocumentType('Ninguno');
                }
                if($raw->getNotaryName()==null){
                    $raw->setNotaryName('Notari@');
                }
                if($raw->getProtocolNumber()==null){
                    $raw->setProtocolNumber('0');
                }
                if($raw->getFolioNumber()==null){
                    $raw->setFolioNumber('0');
                }
                if($raw->getFilename()==null){
                    $raw->setFilename('Ninguno');
                }
                $datosFoto = json_decode($registro['subject_data'], True);
                $idFoto = (int) $registro['subject_ids'];
                $raw->setFilename($datosFoto[$idFoto]['Filename']);

                if(!$segOtor){
                    $raw->setSecondGrantor(FALSE);
                    $raw->setSecondGrantorName("Ningun@");
                }

                $imagen = $em->getRepository(TestaTimagen::class)->findOneBy(['des_imagen' => $raw->getFilename()]);
                if($imagen){
                    $imagen = new TestaTimagen();
                    $imagen->setDesImagen($raw->getFilename());
                    $em->persist($imagen);
                }

                $notario = $em->getRepository(TestaTnotario::class)->findOneBy(['des_notario' => $raw->getNotaryName()]);
                if($notario==null){
                    $notario = new TestaTnotario();
                    $notario->setDesNotario($raw->getNotaryName());
                    $em->persist($notario);
                }

                $otorgante = new TestaTotorgante();
                $otorgante->setNombre($raw->getGrantorName());
                $otorgante->setApellido1($raw->getGrantorSurname1());
                $otorgante->setApellido2($raw->getGratorSurname2());

                $oficio = $em->getRepository(TestaToficio::class)->findOneBy(['des_oficio' => $raw->getGrantorOffice()]);
                if ($oficio==null){
                    $oficio = new TestaToficio();
                    $oficio->setDesOficio($raw->getGrantorOffice());
                    $oficio->addIdOtorgante($otorgante);
                    $otorgante->setIdOficio($oficio);
                    $em->persist($oficio);
                } else{
                    $oficio->addIdOtorgante($otorgante);
                    $otorgante->setIdOficio($oficio);
                    $em->persist($oficio);
                }

                $parentesco = $em->getRepository(TestaTparentesco::class)->findOneBy(['des_parentesco' => $raw->getGrantorRelationship()]); 
                if($parentesco){
                    $parentesco = new TestaTparentesco();
                    $parentesco->setDesParentesco($raw->getGrantorRelationship());
                    $em->persist($parentesco);
                }

                $pobalcion = $em->getRepository(TestaTpoblacion::class)->findOneBy(['des_poblacion' => $raw->getPopulationName()]);
                if($pobalcion==null){
                    $pobalcion = new TestaTpoblacion();
                    $pobalcion->setDesPoblacion($raw->getPopulationName());
                    $em->persist($pobalcion);
                }

                if($raw->isSecondGrantor()){
                    $segOtorgante = new TestaTotorgante();
                    $segOtorgante->setNombre($raw->getSecondGrantorName());
                    $segOtorgante->setApellido1($raw->getSecondGrantorName());
                    $segOtorgante->setApellido2($raw->getSecondGrantorName());
                    $segOtorgante->setIdOficio($oficio);
                    $em->persist($segOtorgante);
                }

                $testamento = new testaTtestamento();
                $testamento->setAnno($raw->getYear());
                $testamento->setMes($raw->getMonth());
                $testamento->setDia($raw->GetDay());
                $testamento->setMancomunado($raw->isSecondGrantor());
                $testamento->setTextoIlegible($ilegible);
                $testamento->setNumProtocolo($raw->getProtocolNumber());
                $testamento->setNumFolio($raw->getFolioNumber());
                $testamento->setIdPoblacion($pobalcion);
                $testamento->setIdNotario($notario);
                $testamento->setIdParentesco($parentesco);
                $testamento->setIdImagen($imagen);
                $em->persist($testamento);

                $testaOtorgante = new TestaTtestaotorgante();
                $testaOtorgante->setIdTestamento($testamento);
                $testaOtorgante->setIdOtorgante($otorgante);
                $testaOtorgante->setNumOrden(1);
                $em->persist($testaOtorgante);
                
                if($raw->isSecondGrantor()){
                    $testaOtorSeg = new TestaTtestaotorgante();
                    $testaOtorSeg->setIdTestamento($testamento);
                    $testaOtorSeg->setIdOtorgante($segOtorgante);
                    $testaOtorSeg->setNumOrden(2);
                    $em->persist($testaOtorSeg);
                }

                $em->persist($raw);

            }
            if ((($i % $lote) === 0)) {
                $em->flush();
                $em->clear();
            }
            $i++;
        }
        $em->flush();
        $em->clear();
        return $i;
    }
    
}