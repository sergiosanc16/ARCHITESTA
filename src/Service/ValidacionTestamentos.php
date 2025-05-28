<?php
namespace App\Service;

use Symfony\Component\Form\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Types\Types;
use App\Entity\TestaTraw;
use App\Entity\TestaTtestamento;
use App\Entity\TestaTvalidacion;
use App\Entity\TestaTimagen;
use App\Entity\TestaTotorgante;
use App\Entity\TestaTtestaotorgante;
use App\Repository\TestaTtestamentoRepository;

class ValidacionTestamentos{

    public static function validacion(Form $form, EntityManagerInterface $em): string
    {

        //Hacer automatico, no recibe de la entrada la imagen

        if($form->get('tipo')->getData() == 1){
            $fotos = $em->getRepository(TestaTimagen::class)->findBy(['des_imagen' => $form->get('foto')->getData()]);
        } else {
            $fotos = $em->getRepository(TestaTimagen::class)->findAll();
        }
        $testTotal = 0;
        $flush = 0;
        $lote = 20;
        foreach($fotos as $idFoto){
            $testamentos = $em->getRepository(TestaTtestamento::class)->findTestaImagenNoValidado($idFoto);
            $size = count($testamentos);
            dump($size);
            $totalSize = 0;
            $auxSize = $size - 1;
            $otorgantes=[];
            for($i = 0;$i<$size;$i++){
                $otorgantes[$i] = $em->getRepository(TestaTtestaotorgante::class)->findBy(['testamento' => $testamentos[$i]->getId()]);
                $totalSize += $auxSize;
                $auxSize--;
            }
            dump($totalSize);
            
            $validaciones = [];
            if($size>=3){
                for($i=0; $i<$size;$i++){
                    $testamentos[$i]->setEstadoValidacion('A');
                    $em->persist($testamentos[$i]);
                    $validaciones[$i] = new TestaTvalidacion($testamentos[$i]);
                }

                //comparar anno
                $pAnno = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        if($validaciones[$i]->getIdTestamento()->getAnno() == $validaciones[$j]->getIdTestamento()->getAnno()){
                            $aux++;
                        }
                    }
                }
                $pAnno = ($aux / $totalSize)*100;

                //comparar mes
                $pMes = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        $p = 0;
                        $mes1 = strtoupper($validaciones[$i]->getIdTestamento()->getMes());
                        $mes2 = strtoupper($validaciones[$j]->getIdTestamento()->getMes());
                        similar_text($mes1, $mes2, $p);
                        $aux += $p;
                    }
                }
                $pMes = ($aux / $totalSize);

                //comparar dia
                $pDia = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        if($validaciones[$i]->getIdTestamento()->getDia() == $validaciones[$j]->getIdTestamento()->getDia()){
                            $aux++;
                        }
                    }
                }
                $pDia = ($aux / $totalSize)*100;

                //comparar mancomunado
                $pMancomunadoAnno = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        if($validaciones[$i]->getIdTestamento()->isMancomunado() == $validaciones[$j]->getIdTestamento()->isMancomunado()){
                            $aux++;
                        }
                    }
                }
                $pMancomunado = ($aux / $totalSize)*100;

                //comparar textoilegible
                $pIlegible = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        if($validaciones[$i]->getIdTestamento()->isTextoilegible() == $validaciones[$j]->getIdTestamento()->isTextoilegible()){
                            $aux++;
                        }
                    }
                }
                $pIlegible = ($aux / $totalSize)*100;

                //comparar num_protocolo
                $pProtocolo = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        if($validaciones[$i]->getIdTestamento()->getNumProtocolo() == $validaciones[$j]->getIdTestamento()->getNumProtocolo()){
                            $aux++;
                        }
                    }
                }
                $pProtocolo = ($aux / $totalSize)*100;

                //comparar num_folio
                $pFolio = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        if($validaciones[$i]->getIdTestamento()->getNumFolio() == $validaciones[$j]->getIdTestamento()->getNumFolio()){
                            $aux++;
                        }
                    }
                }
                $pFolio = ($aux / $totalSize)*100;

                //comparar des de poblacion
                $pPoblacion = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        $p = 0;
                        $pob1 = strtoupper($validaciones[$i]->getIdTestamento()->getPoblacion()->getDesPoblacion());
                        $pob2 = strtoupper($validaciones[$j]->getIdTestamento()->getPoblacion()->getDesPoblacion());
                        similar_text($pob1, $pob2, $p);
                        dump($p);
                        $aux += $p;
                        dump($aux);
                    }
                }
                $pPoblacion = ($aux / $totalSize);

                //comparar nombre de notario
                $pNotario = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        $p = 0;
                        $not1 = strtoupper($validaciones[$i]->getIdTestamento()->getNotario()->getDesNotario());
                        $not2 = strtoupper($validaciones[$j]->getIdTestamento()->getNotario()->getDesNotario());
                        similar_text($not1, $not2, $p);
                        $aux += $p;
                    }
                }
                $pNotario = ($aux / $totalSize);

                //comparar documento
                $pDoc = 0;
                $aux = 0;
                for($i = 0;$i<$size;$i++){
                    for($j = $i;$j<$size-1;$j++){
                        $p = 0;
                        $not1 = strtoupper($validaciones[$i]->getIdTestamento()->getTipoDoc());
                        $not2 = strtoupper($validaciones[$j]->getIdTestamento()->getTipoDoc());
                        similar_text($not1, $not2, $p);
                        $aux += $p;
                    }
                }
                $pDoc = ($aux / $totalSize);

                //comparador de otorgante por todas sus propiedades TODO
                $pNom = 0;
                $pAp1 = 0;
                $pAp2 = 0;
                $pOfi = 0;
                $pPar = 0;
                $count = 0;
                for($i=0;$i< count($otorgantes);$i++ ){
                    for($j=$i;$j<count($otorgantes);$j++){
                        for($t=0;$t<count($otorgantes[$i]);$t++){
                            $count++;
                            $pAux=0;
                            //nombre
                            $nom1 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getNombre());
                            $nom2 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getNombre());
                            similar_text($nom1, $nom2, $pAux);
                            $pNom += $pAux;
                            //apellido1
                            $ap11 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getApellido1());
                            $ap12 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getApellido1());
                            similar_text($ap11, $ap12, $pAux);
                            $pAp1 += $pAux;
                            //apellid2
                            $ap21 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getApellido2());
                            $ap22 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getApellido2());
                            similar_text($ap21, $ap22, $pAux);
                            $pAp2 += $pAux;
                            //oficio
                            $ofi1 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getIdOficio()->getDesOficio());
                            $ofi2 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getIdOficio()->getDesOficio());
                            similar_text($ofi1, $ofi2, $pAux);
                            $pOfi += $pAux;
                            //parentesco
                            $par1 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getParentesco()->getDesParentesco());
                            $par2 = strtoupper($otorgantes[$i][$t]->getOtorgante()->getParentesco()->getDesParentesco());
                            similar_text($par1, $par2, $pAux);
                            $pPar += $pAux;
                        }
                    }
                }
                $pOtorgante = ($pNom + $pAp1 + $pAp2 + $pOfi + $pPar) / ($count * 5);

                $pMedio = ($pAnno + $pMes + $pDia + $pMancomunado + 
                        $pIlegible + $pProtocolo + $pFolio + 
                        $pPoblacion + $pNotario + $pOtorgante + $pDoc) / 11;

                $valMedios = array(
                                    "anno" => $pAnno,
                                    "mes" => $pMes,
                                    "dia" => $pDia,
                                    "mancomunado" => $pMancomunado,
                                    "ilegible" => $pIlegible,
                                    "protocolo" => $pProtocolo,
                                    "folio" => $pFolio,
                                    "poblacion" => $pPoblacion,
                                    "notario" => $pNotario,
                                    "otorgante" => $pOtorgante,
                                    "documento" => $pDoc
                );
                        
                for($i=0; $i<$size;$i++){
                    $validaciones[$i]->setNumvalidacion($pMedio);
                    $validaciones[$i]->setvalidaciones($valMedios);
                    $em->persist($validaciones[$i]);
                }
                if ((($flush % $lote) === 0)) {
                    $em->flush();
                    $em->clear();
                }
            
                $flush++;
            }
        }
        $em->flush();
        $em->clear();
                
        return "Se han validado $flush testamentos";
    }
}