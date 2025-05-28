<?php
namespace App\Service;

use App\Entity\TestaVtestavalidacion;
use App\Form\TestaTvalidacionType;
use App\Repository\TestaTvalidacionRepository;
use App\Repository\TestaVtestavalidacionRepository;
use Symfony\Component\Form\Form;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\Types\Types;
use App\Entity\TestaTraw;
use App\Entity\TestaTtestamento;
use App\Entity\TestaTvalidacion;
use App\Entity\TestaTimagen;
use App\Entity\TestaTotorgante;
use App\Entity\TestaTtestaotorgante;
use App\Entity\testaTpoblacion;
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

        $pobla = $em->getRepository(TestaTpoblacion::class)->find($poblacion);
        $testaTtestamento->setPoblacion($pobla);
        $nota = $em->getRepository(TestaTnotario::class)->find($notario);
        $testaTtestamento->setNotario($nota);
        $imag = $em->getRepository(TestaTimagen::class)->find($imagen);
        $testaTtestamento->setImagen($imag);
        $testaTtestamento->setEstadovalidacion('M');

        $em->persist($testaTtestamento);
        $em->flush();        

        for($i=0; $i<count($otorgantes); $i++) {
            $testaTtestaotorgante = new TestaTtestaotorgante();
            $testaTtestaotorgante->setTestamento($testaTtestamento);
            $otor = $em->getRepository(TestaTotorgante::class)->find($otorgantes[$i]);
            $testaTtestaotorgante->setOtorgante($otor);
            $testaTtestaotorgante->setNumOrden($i+1);

            $em->persist($testaTtestaotorgante);
            $em->flush();        
        }

        return $testaTtestamento;
    }
}