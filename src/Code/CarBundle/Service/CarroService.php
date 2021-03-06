<?php

namespace Code\CarBundle\Service;

use Code\CarBundle\Entity\CarroInterface;

class CarroService
{
	private $em;

	public function __construct(\Doctrine\ORM\EntityManagerInterface $em)
	{
		$this->em = $em; 
	}

	public function insert(CarroInterface $entity)
	{
        $em = $this->em;
        $em->persist($entity);
        $em->flush();

        return $entity;
	}

	public function find($repositorio, $id)
	{
		return $this->em->getRepository($repositorio)->find($id);
	}	

	public function remove(CarroInterface $entity)
	{
		$em = $this->em;
        $em->remove($entity);
        $em->flush();
	}	
}