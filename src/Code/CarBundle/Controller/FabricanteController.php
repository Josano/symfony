<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Code\CarBundle\Entity\Fabricante;
use Code\CarBundle\Form\FabricanteType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/fabricante")
 */
class FabricanteController extends Controller
{
    /**
     * @Route("/", name="fabricante")
     * @Template()
     */
    public function indexAction(){

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository("CodeCarBundle:Fabricante");
        $fabricantes = $repo->findAll();
        return['fabricantes'=>$fabricantes];
    }

    /**
     * @Route("/new", name="fabricante_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fabricante();
        $form = $this->createForm(new FabricanteType(), $entity);
        return[
            'entity' => $entity,
            'form'   => $form->createView()
        ];
    }   

    /**
     * @Route("/create", name="fabricante_create")
     * @Template("CodeCarBundle:Fabricante:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Fabricante();
        $form = $this->createForm(new FabricanteType(), $entity);
        $form->bind($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fabricante'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    } 
/*
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
/*    
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
    */

}
