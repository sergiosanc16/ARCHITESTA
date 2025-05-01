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

        //Eliminar cabecera
        $campos = fgetcsv($csvTemp,0, ',', '"');

        $lote = 20;
        $flush = 0;
        $raw = new TestaTraw();
        $segOtor=FALSE;
        $ilegible = FALSE;

        while(($campos = fgetcsv($csvTemp,0, ',', '"'))!= false){
            $idTask = 0;

            foreach($campos as $id => $tarea){
                if (stripos($tarea,'task')!=FALSE){
                    $idTask = $id;
                    break;
                }
            }
        
            $ilegible = FALSE;
            $raw = new TestaTraw();
            $raw->setClassificationId($campos['0']);
            $json = $campos[$idTask] ?? '';


            if ($json !== '' && ($json[0] === '"' || $json[0] === "'")
                && $json[0] === $json[strlen($json) - 1]) {
                $json = substr($json, 1, -1);          // descarta 1ª y última comilla
                $json = str_replace('""', '"', $json); // desdobla "" a "
            }

            // Quita posible BOM UTF-8
            $json = preg_replace('/^\xEF\xBB\xBF/', '', $json);

            // Elimina caracteres de control no imprimibles
            $json = preg_replace('/[[:^print:]\s]/u', '', $json);

            // Descarta strings vacíos
            if (trim($json) === '') {
                continue;
            }

            /* 5.3 Valida con json_validate() si tu PHP ≥ 8.3 --------------- */
            if (function_exists('json_validate') && !json_validate($json, JSON_INVALID_UTF8_SUBSTITUTE)) {
                continue;            // JSON inválido → ignora la fila o notifícala
            }

            /* 5.4 Intenta la decodificación con excepciones ---------------- */
            try {
                $datosTareas = json_decode(
                    $json,
                    true,
                    512,
                    JSON_THROW_ON_ERROR | JSON_INVALID_UTF8_SUBSTITUTE
                );
            } catch (\JsonException $e) {
                // Si quieres loggear el error para auditoría:
                error_log('Fila JSON inválida: '.$e->getMessage().' ➜ '.$json);
                continue;            // ignora la fila y pasa a la siguiente
            }


            $datosTareas = json_decode($campos[$idTask], true);
            dump($campos);
            dump($datosTareas);

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
                        case 'T21':
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
                $idFichero = intval($idTask);
                $idFichero = strval(++$idFichero);
                $ficheroFoto = json_decode($campos[$idFichero], true);
                $idFoto = array_keys($ficheroFoto);
                $raw->setFilename($ficheroFoto[$idFoto[0]]['Filename'] );

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
                if(!$segOtor){
                    $raw->setSecondGrantor(FALSE);
                    $raw->setSecondGrantorName("Ningun@");
                }
                $em->persist($raw);

                
                $imagen = $em->getRepository(TestaTimagen::class)->findOneBy(['des_imagen' => $raw->getFilename()]);
                if($imagen==null){
                    $imagen = new TestaTimagen($raw->getFilename());
                    $em->persist($imagen);
                }

                $notario = $em->getRepository(TestaTnotario::class)->findOneBy(['des_notario' => $raw->getNotaryName()]);
                if($notario==null){
                    $notario = new TestaTnotario($raw->getNotaryName());
                    $em->persist($notario);
                }

                $oficio = $em->getRepository(TestaToficio::class)->findOneBy(['des_oficio' => $raw->getGrantorOffice()]);
                if ($oficio==null){
                    $oficio = new TestaToficio($raw->getGrantorOffice());
                    $em->persist($oficio);
                }

                $otorgante = new TestaTotorgante($raw->getGrantorName(),$raw->getGrantorSurname1(),
                                                $raw->getGratorSurname2(),$oficio);
                $em->persist($otorgante);

                $parentesco = $em->getRepository(TestaTparentesco::class)->findOneBy(['des_parentesco' => $raw->getGrantorRelationship()]); 
                if($parentesco==null){
                    $parentesco = new TestaTparentesco($raw->getGrantorRelationship());
                    $em->persist($parentesco);
                }

                $pobalcion = $em->getRepository(TestaTpoblacion::class)->findOneBy(['des_poblacion' => $raw->getPopulationName()]);
                if($pobalcion==null){
                    $pobalcion = new TestaTpoblacion($raw->getPopulationName());
                    $em->persist($pobalcion);
                }

                if($raw->isSecondGrantor()){
                    $segOtorgante = new TestaTotorgante($raw->getSecondGrantorName(),
                                                        $raw->getSecondGrantorName(), $raw->getSecondGrantorName(), $oficio);
                    $em->persist($segOtorgante);
                }

                $testamento = new testaTtestamento($raw->getYear(), $raw->getMonth(), $raw->GetDay(), $raw->isSecondGrantor(),
                                                   $ilegible, $raw->getProtocolNumber(), $raw->getFolioNumber(), $pobalcion,
                                                   $notario,$imagen, $parentesco );
                $em->persist($testamento);

                $testaOtorgante = new TestaTtestaotorgante($testamento, $otorgante, 1);
                $em->persist($testaOtorgante);
                
                if($raw->isSecondGrantor()){
                    $testaOtorSeg = new TestaTtestaotorgante($testamento, $otorgante, 2);
                    $em->persist($testaOtorSeg);
                }

            }
            if ((($flush % $lote) === 0)) {
                $em->flush();
                $em->clear();
            }
            $flush++;
        }
        $em->flush();
        $em->clear();
        return $flush;
    }
    
}