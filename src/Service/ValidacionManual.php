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

class ValidacionManual{

    public static function validacion(Request $request, EntityManagerInterface $em): TestaTtestamento
    {

        $documento = $request->request->get('documento');
 //       var_dump($documento);
        $anno = $request->request->get('anno');
 //       var_dump($anno);
        $mes = $request->request->get('mes');
 //       var_dump($mes);
        $dia = $request->request->get('dia');
 //       var_dump($dia);
        $mancomunado = $request->request->get('mancomunado');
 //       var_dump($mancomunado);
        $ilegible = $request->request->get('ilegible');
 //       var_dump($ilegible);
        $protocolo = $request->request->get('protocolo');
 //       var_dump($protocolo);
        $folio = $request->request->get('folio');
 //       var_dump($folio);
        $poblacion = $request->request->get('poblacion');
 //       var_dump($poblacion);
        $notario = $request->request->get('notario');
 //       var_dump($notario);
        $imagen = $request->request->get('imagen');
 //       var_dump($imagen);

        $otorgantes = $request->request->all('otorgante');
//        var_dump($otorgantes);
        $testaTtestamento = new TestaTtestamento();
        $testaTtestamento->setTipoDoc($documento);
        $testaTtestamento->setAnno($anno);
        $testaTtestamento->setMes($mes);
        $testaTtestamento->setdia($dia);
        $testaTtestamento->setMancomunado($mancomunado);
        $testaTtestamento->setTextoilegible($ilegible);
        $testaTtestamento->setNumProtocolo($protocolo);
        $testaTtestamento->setNumFolio($folio);

        $pobla = $entityManager->getRepository(testaTpoblacion::class)->find($poblacion);
        $testaTtestamento->setPoblacion($pobla);
        $nota = $entityManager->getRepository(testaTnotario::class)->find($notario);
        $testaTtestamento->setNotario($nota);
        $imag = $entityManager->getRepository(testaTimagen::class)->find($imagen);
        $testaTtestamento->setImagen($imag);
        $testaTtestamento->setEstadovalidacion('M');

        $entityManager->persist($testaTtestamento);
        $entityManager->flush();        

        for($i=0; $i<count($otorgantes); $i++) {
            $testaTtestaotorgante = new TestaTtestaotorgante();
            $testaTtestaotorgante->setTestamento($testaTtestamento);
            $otor = $entityManager->getRepository(testaTotorgante::class)->find($otorgantes[$i]);
            $testaTtestaotorgante->setOtorgante($otor);
            $testaTtestaotorgante->setNumOrden($i+1);

            $entityManager->persist($testaTtestaotorgante);
            $entityManager->flush();        
        }

        return $testaTtestamento;
    }
}