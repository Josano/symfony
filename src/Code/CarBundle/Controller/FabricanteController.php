<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Code\CarBundle\Service\FabricanteService;
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
            $fabricanteService = new FabricanteService($em);
            $fabricanteService->insert($entity);

            return $this->redirect($this->generateUrl('fabricante'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    } 

    /**
     * @Route("/{id}/edit", name="fabricante_edit")
     * @Template()
     */
    public function editAction($id)
    {

          $em = $this->getDoctrine()->getManager();
          $fabricanteService = new FabricanteService($em);
          $entity = $fabricanteService->find("CodeCarBundle:Fabricante", $id);          

          if(!$entity){
              throw $this->createNotFoundException("Registro não encontrado");
          }

          $form = $this->createForm(new FabricanteType(), $entity);
          return[
              'entity' => $entity,
              'form'   => $form->createView()
          ];
    }     

    /**
     * @Route("/{id}/update", name="fabricante_update")
     * @Template("CodeCarBundle:Fabricante:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $fabricanteService = new FabricanteService($em);
        $entity = $fabricanteService->find("CodeCarBundle:Fabricante", $id);  

        if(!$entity){
            throw $this->createNotFoundException("Registro não encontrado");      
        }   

        $form = $this->createForm(new FabricanteType(), $entity); 
        $form->bind($request);

        if($form->isValid()){
            $fabricanteService->record($entity);

            return $this->redirect($this->generateUrl("fabricante"));
        }                

        return[
            'entity' => $entity,
            'form'   => $form->createView()
        ];

    }    

    /**
     * @Route("/{id}/delete", name="fabricante_delete")
     * @Template()
     */    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $fabricanteService = new FabricanteService($em);
        $entity = $fabricanteService->find("CodeCarBundle:Fabricante", $id);  

        if(!$entity){
            throw $this->createNotFoundException("Registro não encontrado");      
        }

        $fabricanteService->remove($entity);   

        return $this->redirect($this->generateUrl("fabricante"));
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
