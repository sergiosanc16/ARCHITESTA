<?php
namespace App\Service;

use Symfony\Component\Form\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Types\Types;
use App\Entity\TestaTraw;
use App\Entity\TestaTtestamento;
use App\Entity\TestaTValidacion;
use App\Entity\TestaTimagen;
use App\Repository\TestaTtestamentoRepository;

class ValidacionTestamentos{

    public static function validacion(Form $form, EntityManagerInterface $em): string
    {

        //Seleccionar de la base de datos 3 registros por filename
        $idFoto = $em->getRepository(TestaTimagen::class)->findOneBy(['des_imagen' => $form->get('foto')->getData()]);

        $fotos = $em->getRepository(TestaTtestamento::class)->findTestaImagen(idFoto);

        dump($fotos);
        dump(count($fotos));
        $validaciones = [];
        $size = count($fotos);
        if($size>=3){
            for($i=0; $i<$size;$i++){
                $validaciones[$i] = new TestaTValidacion($fotos[$i]);
                dump($validaciones[$i]);
            }
        
            dump($validaciones);

            //comparar anno
            $pAnno = 0;
            if(($validaciones[0]->getIdTestamento()->getAnno() == $validaciones[1]->getIdTestamento()->getAnno()) &&
            ($validaciones[0]->getIdTestamento()->getAnno() == $validaciones[2]->getIdTestamento()->getAnno())){
                    $pAnno = 100;
            } else if($validaciones[1]->getIdTestamento()->getAnno() == $validaciones[2]->getIdTestamento()->getAnno() ||
                    $validaciones[0]->getIdTestamento()->getAnno() == $validaciones[2]->getIdTestamento()->getAnno()){
                    $pAnno = 66;
            } else {
                $pAnno = 33;
            }
            //comparar mes
            $pMes = 0;
            $mes1 = strtoupper($validaciones[0]->getIdTestamento()->getMes());
            $mes2 = strtoupper($validaciones[1]->getIdTestamento()->getMes());
            $mes3 = strtoupper($validaciones[2]->getIdTestamento()->getMes());
            similar_text($mes1, $mes2, $p1);
            similar_text($mes1, $mes3, $p2);
            similar_text($mes2, $mes3, $p3);
            $pMes = ($p1+$p2+$p3)/3;

            //comparar dia
            $pDia = 0;
            if(($validaciones[0]->getIdTestamento()->getDia() == $validaciones[1]->getIdTestamento()->getDia()) &&
            ($validaciones[0]->getIdTestamento()->getDia() == $validaciones[2]->getIdTestamento()->getDia())){
                    $pDia = 100;
            } else if($validaciones[1]->getIdTestamento()->getDia() == $validaciones[2]->getIdTestamento()->getDia() ||
                    $validaciones[0]->getIdTestamento()->getDia() == $validaciones[2]->getIdTestamento()->getDia()){
                    $pDia = 66;
            } else {
                $pDia = 33;
            }
            //comparar mancomunado
            $pMancomunado = 0;
            if(($validaciones[0]->getIdTestamento()->isMancomunado() == $validaciones[1]->getIdTestamento()->isMancomunado()) &&
            ($validaciones[0]->getIdTestamento()->isMancomunado() == $validaciones[2]->getIdTestamento()->isMancomunado())){
                    $pMancomunado = 100;
            } else if($validaciones[1]->getIdTestamento()->isMancomunado() == $validaciones[2]->getIdTestamento()->isMancomunado() ||
                    $validaciones[0]->getIdTestamento()->isMancomunado() == $validaciones[2]->getIdTestamento()->isMancomunado()){
                    $pMancomunado = 66;
            } else {
                $pMancomunado = 33;
            }
            //comparar textoilegible
            $pIlegible = 0;
            if(($validaciones[0]->getIdTestamento()->isTextoilegible() == $validaciones[1]->getIdTestamento()->isTextoilegible()) &&
            ($validaciones[0]->getIdTestamento()->isTextoilegible() == $validaciones[2]->getIdTestamento()->isTextoilegible())){
                    $pIlegible = 100;
            } else if($validaciones[1]->getIdTestamento()->isTextoilegible() == $validaciones[2]->getIdTestamento()->isTextoilegible() ||
                    $validaciones[0]->getIdTestamento()->isTextoilegible() == $validaciones[2]->getIdTestamento()->isTextoilegible()){
                    $pIlegible = 66;
            } else {
                $pIlegible = 33;
            }
            //comparar num_protocolo
            $pProtocolo = 0;
            if(($validaciones[0]->getIdTestamento()->getNumProtocolo() == $validaciones[1]->getIdTestamento()->getNumProtocolo()) &&
            ($validaciones[0]->getIdTestamento()->getNumProtocolo() == $validaciones[2]->getIdTestamento()->getNumProtocolo())){
                    $pProtocolo = 100;
            } else if($validaciones[1]->getIdTestamento()->getNumProtocolo() == $validaciones[2]->getIdTestamento()->getNumProtocolo() ||
                    $validaciones[0]->getIdTestamento()->getNumProtocolo() == $validaciones[2]->getIdTestamento()->getNumProtocolo()){
                    $pProtocolo = 66;
            } else {
                $pProtocolo = 33;
            }
            //comparar num_folio
            $pFolio = 0;
            if(($validaciones[0]->getIdTestamento()->getNumFolio() == $validaciones[1]->getIdTestamento()->getNumFolio()) &&
            ($validaciones[0]->getIdTestamento()->getNumFolio() == $validaciones[2]->getIdTestamento()->getNumFolio())){
                    $pFolio = 100;
            } else if($validaciones[1]->getIdTestamento()->getNumFolio() == $validaciones[2]->getIdTestamento()->getNumFolio() ||
                    $validaciones[0]->getIdTestamento()->getNumFolio() == $validaciones[2]->getIdTestamento()->getNumFolio()){
                    $pFolio = 66;
            } else {
                $pFolio = 33;
            }
            //comparar des de poblacion
            $pPoblacion = 0;
            $pob1 = strtoupper($validaciones[0]->getIdTestamento()->getPoblacion()->getDesPoblacion());
            $pob2 = strtoupper($validaciones[1]->getIdTestamento()->getPoblacion()->getDesPoblacion());
            $pob3 = strtoupper($validaciones[2]->getIdTestamento()->getPoblacion()->getDesPoblacion());
            similar_text($pob1, $pob2, $p1);
            similar_text($pob1, $pob3, $p2);
            similar_text($pob2, $pob3, $p3);
            $pPoblacion = ($p1+$p2+$p3)/3;

            //comparar nombre de notario
            $pNotario = 0;
            $not1 = strtoupper($validaciones[0]->getIdTestamento()->getNotario()->getDesNotario());
            $not2 = strtoupper($validaciones[1]->getIdTestamento()->getNotario()->getDesNotario());
            $not3 = strtoupper($validaciones[2]->getIdTestamento()->getNotario()->getDesNotario());
            similar_text($not1, $not2, $p1);
            similar_text($not1, $not3, $p2);
            similar_text($not2, $not3, $p3);
            $pNotario = ($p1+$p2+$p3)/3;

            //comparar des_parentesco
            $pParentesco = 0;
            $par1 = strtoupper($validaciones[0]->getIdTestamento()->getParentesco()->getDesParentesco());
            $par2 = strtoupper($validaciones[1]->getIdTestamento()->getParentesco()->getDesParentesco());
            $par3 = strtoupper($validaciones[2]->getIdTestamento()->getParentesco()->getDesParentesco());
            similar_text($par1, $par2, $p1);
            similar_text($par1, $par3, $p2);
            similar_text($par2, $par3, $p3);
            $pParentesco = ($p1+$p2+$p3)/3;

            $pMedio = ($pAnno + $pMes + $pDia + $pMancomunado + $pIlegible + $pProtocolo + $pFolio + $pPoblacion + $pNotario + $pParentesco) / 10;
            for($i=0; $i<$size;$i++){
                $validaciones[$i]->setNumValidacion($pMedio);
                $em->persist($validaciones[$i]);
            }

            $em->flush();

            return "Validacion de $size testamentos";
        } else {
            return "ha habido un error en la validacion";
        }

    }
}