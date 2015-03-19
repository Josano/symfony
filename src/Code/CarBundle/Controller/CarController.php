<?php

namespace Code\CarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Code\CarBundle\Entity\Carro;
use Code\CarBundle\Form\CarroType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/carro")
 */
class CarController extends Controller
{
    /**
     * @Route("/", name="carro")
     * @Template()
     */
    public function indexAction(){

        $em = $this->getDoctrine()->getEntityManager();
        $repo = $em->getRepository("CodeCarBundle:Carro");
        $carro = $repo->findAll();
        return['carros'=>$carro];
    }

    /**
     * @Route("/new", name="carro_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Carro();
        $form = $this->createForm(new CarroType(), $entity);
        return[
            'entity' => $entity,
            'form'   => $form->createView()
        ];
    }

    /**
     * @Route("/create", name="carro_create")
     * @Template("CodeCarBundle:carro:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new carro();
        $form = $this->createForm(new CarroType(), $entity);
        $form->bind($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carro'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    } 

    /**
     * @Route("/{id}/edit", name="carro_edit")
     * @Template()
     */
    public function editAction($id)
    {

          $em = $this->getDoctrine()->getManager();

          $entity = $em->getRepository("CodeCarBundle:Carro")->find($id);

          if(!$entity){
              throw $this->createNotFoundException("Registro não encontrado");
          }

          $form = $this->createForm(new CarroType(), $entity);
          return[
              'entity' => $entity,
              'form'   => $form->createView()
          ];
    }     

    /**
     * @Route("/{id}/update", name="carro_update")
     * @Template("CodeCarBundle:Carro:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CodeCarBundle:Carro")->find($id);

        if(!$entity){
            throw $this->createNotFoundException("Registro não encontrado");      
        }   

        $form = $this->createForm(new CarroType(), $entity); 
        $form->bind($request);

        if($form->isValid()){
          $em->persist($entity);
          $em->flush();

          return $this->redirect($this->generateUrl("carro"));
        }                

        return[
            'entity' => $entity,
            'form'   => $form->createView()
        ];

    }    

    /**
     * @Route("/{id}/delete", name="carro_delete")
     * @Template()
     */    public function deleteAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository("CodeCarBundle:Carro")->find($id);

        if(!$entity){
            throw $this->createNotFoundException("Registro não encontrado");      
        }

        $em->remove($entity);
        $em->flush();   

        return $this->redirect($this->generateUrl("carro"));
    }



    /**
     * @Route("/", name="carro_index")
     */
   /* public function indexAction()
    {
        return $this->render('CodeCarBundle:Car:index.html.twig');
    }

    /**
     * @Route("/listarCarros", name="carro_listar")
     */
    /*public function carsAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $repo = $em->getRepository("CodeCarBundle:Carro");

        $veiculos = $repo->findBy(array(), array('fabricante'=>'ASC'));

        return $this->render('CodeCarBundle:Car:cars.html.twig', ['veiculos'=>$veiculos]);
    } 

    /**
     * @Route("/adicionarModelo", name="carro_adicionar")
     * @Template()
     */
    /*public function adicionarModeloAction(){

        $carros = array(
                          array("modelo" => "147 C/ CL", "fabricante" => 1, "ano" => 1980, "cor"=> "BRANCO"),
                          array("modelo" => "120iA 2.0 16V 156cv 3p", "fabricante" => 2, "ano" => 2009, "cor"=> "AZUL"),
                          array("modelo" => "AIRCROSS TENDANCE 1.6 Flex 16V 5p Mec.", "fabricante" => 3, "ano" => 2014, "cor"=> "AMARELO"),
                          array("modelo" => "Rapide S 6.0 V12 550cv", "fabricante" => 4, "ano" => 2011, "cor"=> "VERDE"),
                          array("modelo" => "GranTurismo S 4.7 V8 32V/ MC Line", "fabricante" => 5, "ano" => 2012, "cor"=> "PRETO"),
                          array("modelo" => "AGILE LTZ EASYTRONIC 1.4 8V", "fabricante" => 6, "ano" => 2008, "cor"=> "CINZA"),
                          array("modelo" => "AMAROK CD2.0 16V/S CD2.0 16V TDI 4x2 Die", "fabricante" => 7, "ano" => 2014, "cor"=> "PRATA"),
                          array("modelo" => "Corolla XEi 1.8/1.8", "fabricante" => 8, "ano" => 2015, "cor"=> "ROXO"),
                          array("modelo" => "Palio 1.0 Celebr. ECONOMY F.Flex 8V 4p", "fabricante" => 1, "ano" => 2015, "cor"=> "GRAFITE"),
                          array("modelo" => "911 Turbo Cabriolet 3.6/3.8", "fabricante" => 9, "ano" => 2003, "cor"=> "PRETO"),
                          array("modelo" => "F599 GTB Fiorano F1 6.0 V12 620cv", "fabricante" => 10, "ano" => 2015, "cor"=> "VERMELHO"),                                
                       );

        $em = $this->getDoctrine()->getEntityManager();
        $tam = count($carros); 

        for($i=0;$i<$tam;$i++){
            $novoModelo = new Carro();

            foreach($carros[$i] as $key=>$value){
                switch ($key) {
                  case $key == 'modelo':
                       $novoModelo->setModelo($value);
                    break;
                  case $key == 'fabricante':
                       $fabricante = $this->getDoctrine()->getManager()->getRepository('CodeCarBundle:Fabricante')->findOneById($value);
                       $novoModelo->setFabricante($fabricante); 
                    break;
                  case $key == 'ano':
                       $novoModelo->setAno($value);
                    break;
                  case $key == 'cor':
                       $novoModelo->setCor($value);
                    break;        
                }  
            }
            
            $em->persist($novoModelo);  
            $em->flush();  
        }

        return new Response('Modelos cadastrados com sucesso.');
        
    }*/

}