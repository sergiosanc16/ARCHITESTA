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
        //Seleccionar de la base de datos 3 registros por filename

        //Hacer automatico, no recibe de la entrada la imagen
        $idFoto = $em->getRepository(TestaTimagen::class)->findOneBy(['des_imagen' => $form->get('foto')->getData()]);
        $testamentos = $em->getRepository(TestaTtestamento::class)->findTestaImagen($idFoto);
        $size = count($testamentos);
        $otorgantes=[];
        for($i = 0;$i<$size;$i++){
            $otorgantes[$i] = $em->getRepository(TestaTtestaotorgante::class)->findBy(["id_testamento"=> $testamentos->getId()]);
        }
        

        $validaciones = [];
        if($size>=3){
            for($i=0; $i<$size;$i++){
                $validaciones[$i] = new TestaTvalidacion($testamentos[$i]);
            }

            //comparar anno
            $pAnno = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    if($validaciones[$i]->getIdTestamento()->getAnno() == $validaciones[$j]->getIdTestamento()->getAnno()){
                        $aux++;
                    }
                }
            }
            $pAnno = ($aux / (($size * ($size+1))/2))*100;

            //comparar mes
            $pMes = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    $p = 0;
                    $mes1 = strtoupper($validaciones[$i]->getIdTestamento()->getMes());
                    $mes2 = strtoupper($validaciones[$j]->getIdTestamento()->getMes());
                    similar_text($mes1, $mes2, $p);
                    $aux += $p;
                }
            }
            $pMes = ($aux / (($size * (($size+1))/2)*100));;

            //comparar dia
            $pDia = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    if($validaciones[$i]->getIdTestamento()->getDia() == $validaciones[$j]->getIdTestamento()->getDia()){
                        $aux++;
                    }
                }
            }
            $pDia = ($aux / (($size * ($size+1))/2))*100;

            //comparar mancomunado

            $pMancomunadoAnno = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    if($validaciones[$i]->getIdTestamento()->isMancomunado() == $validaciones[$j]->getIdTestamento()->isMancomunado()){
                        $aux++;
                    }
                }
            }
            $pMancomunado = ($aux / (($size * ($size+1))/2))*100;

            //comparar textoilegible
            $pIlegible = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    if($validaciones[$i]->getIdTestamento()->isTextoilegible() == $validaciones[$j]->getIdTestamento()->isTextoilegible()){
                        $aux++;
                    }
                }
            }
            $pIlegible = ($aux / (($size * ($size+1))/2))*100;

            //comparar num_protocolo
            $pProtocolo = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    if($validaciones[$i]->getIdTestamento()->getNumProtocolo() == $validaciones[$j]->getIdTestamento()->getNumProtocolo()){
                        $aux++;
                    }
                }
            }
            $pProtocolo = ($aux / (($size * ($size+1))/2))*100;

            //comparar num_folio
            $pFolio = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    if($validaciones[$i]->getIdTestamento()->getNumFolio() == $validaciones[$j]->getIdTestamento()->getNumFolio()){
                        $aux++;
                    }
                }
            }
            $pFolio = ($aux / (($size * ($size+1))/2))*100;

            //comparar des de poblacion
            $pPoblacion = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    $p = 0;
                    $pob1 = strtoupper($validaciones[$i]->getIdTestamento()->getPoblacion()->getDesPoblacion());
                    $pob2 = strtoupper($validaciones[$j]->getIdTestamento()->getPoblacion()->getDesPoblacion());
                    similar_text($pob1, $pob2, $p);
                    $aux += $p;
                }
            }
            $pPoblacion = ($aux / (($size * (($size+1))/2)*100));

            //comparar nombre de notario
            $pNotario = 0;
            $aux = 0;
            for($i = 0;$i<$size-1;$i++){
                for($j = $i;$j<$size;$j++){
                    $p = 0;
                    $not1 = strtoupper($validaciones[$i]->getIdTestamento()->getNotario()->getDesNotario());
                    $not2 = strtoupper($validaciones[$j]->getIdTestamento()->getNotario()->getDesNotario());
                    similar_text($not1, $not2, $p);
                    $aux += $p;
                }
            }
            $pNotario = ($aux / (($size * (($size+1))/2)*100));

            //comparador de otorgante por todas sus propiedades TODO

            //comparar des_parentesco
            // $pParentesco = 0;
            // $par1 = strtoupper($validaciones[0]->getIdTestamento()->getParentesco()->getDesParentesco());
            // $par2 = strtoupper($validaciones[1]->getIdTestamento()->getParentesco()->getDesParentesco());
            // $par3 = strtoupper($validaciones[2]->getIdTestamento()->getParentesco()->getDesParentesco());
            // similar_text($par1, $par2, $p1);
            // similar_text($par1, $par3, $p2);
            // similar_text($par2, $par3, $p3);
            // $pParentesco = ($p1+$p2+$p3)/3;

            $pMedio = ($pAnno + $pMes + $pDia + $pMancomunado + 
                       $pIlegible + $pProtocolo + $pFolio + 
                       $pPoblacion + $pNotario /*+ $pParentesco*/) / 10;

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
                                // "parentesco" => $pParentesco,
            );
                       
            for($i=0; $i<$size;$i++){
                $validaciones[$i]->setNumvalidacion($pMedio);
                $validaciones[$i]->setvalidaciones($valMedios);
                $em->persist($validaciones[$i]);
            }

            $em->flush();

            return "validacion de $size testamentos";
        } else {
            return "ha habido un error en la validacion";
        }

    }
}