<?php

namespace Code\CarBundle\Entity;

use Doctrine\ORM\EntityRepository;

class CarroRepository extends EntityRepository {

	public function getFabricante($modelo){

		return $this
			->createQueryBuilder('c')
			->innerjoin('c.fabricante_id', 'f')
			->select('c.modelo, f.nome , c.ano, c.cor')
			->where('c.modelo LIKE :modelo')
			->setParameter('modelo', '%'.$modelo.'%')
			->getQuery()
            ->getResult()
        ;

	}
	
}