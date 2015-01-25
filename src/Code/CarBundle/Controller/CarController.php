<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CarController extends Controller
{

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $nome = 'Caio Weber Vidon de Souza';
        return $this->render('CodeCarBundle:Car:index.html.twig',['nome'=>$nome]);
    }

    /**
     * @Route("/cars")
     * @Template()
     */
    public function carsAction()
    {
    	$veiculos = array("FIAT"=>"147 C/ CL", "BMW"=>"120iA 2.0 16V 156cv 3p", 
    					  "CITROEN"=>"AIRCROSS TENDANCE 1.6 Flex 16V 5p Mec.","ASTON MARTIN"=>"Rapide S 6.0 V12 550cv",
    					  "Maserati"=>"GranTurismo S 4.7 V8 32V/ MC Line","GM - Chevrolet"=>"AGILE LTZ EASYTRONIC 1.4 8V",
    					  "VW - VolksWagen"=>"AMAROK CD2.0 16V/S CD2.0 16V TDI 4x2 Die","TOYOTA"=>"Corolla XEi 1.8/1.8 ",
    					  "PORSCHE"=>"911 Turbo Cabriolet 3.6/3.8","FERRARI"=>"F599 GTB Fiorano F1 6.0 V12 620cv"); 

        return array('veiculos' => $veiculos);
    }    
}
