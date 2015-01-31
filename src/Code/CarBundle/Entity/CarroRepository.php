<?php

namespace Code\CarBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CarroRepository extends EntityRepository {

	public function getCarros(){

		return $this
			->createQueryBuilder("c")
			->innerjoin('c.fabricante', 'f')
			->select('c.modelo, f.nome as fabricante, c.ano, c.cor')
			->getQuery()
            ->getResult()
        ;
	}
	
}