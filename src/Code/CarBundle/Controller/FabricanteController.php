<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Code\CarBundle\Entity\Fabricante;

class FabricanteController extends Controller
{
    /**
     * @Route("/listarFabricante", name="fabricante_listar")
     */
    public function fabricanteAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $repo = $em->getRepository("CodeCarBundle:Carro");

        $fabricante = $repo->getFabricante('Palio');

        return $this->render('CodeCarBundle:Car:fabricante.html.twig', ['fabricantes'=>$fabricante]);
    }      

    /**
     * @Route("/adicionarFabricante", name="fabricante_adicionar")
     * @Template()
     */
    public function adicionarFabricanteAction(){

        $fabricantes = array("FIAT", "BMW", "CITROEN", "ASTON MARTIN", "MASERATI","GM - CHEVROLET", "VW - VOLKSVAGEN",
                             "TOYOTA", "PORSCHE","FERRARI"); 

        $em = $this->getDoctrine()->getEntityManager();

        foreach($fabricantes as $fabricante){
          $novoFabricante = new Fabricante();
          $novoFabricante->setNome($fabricante);
          $em->persist($novoFabricante);  
          $em->flush(); 
        }

        return new Response('Fabricantes cadastrados com sucesso.');
        
    }

}
