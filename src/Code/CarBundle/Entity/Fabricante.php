<?php

namespace Code\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Table(name="fabricante")
 *@ORM\Entity(repositoryClass="Code\CarBundle\Entity\FabricanteRepository") 
 */
class Fabricante
{
	/**
     * @ORM\Column(type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;

	 /**
     * @ORM\Column(name="nome", type="string", length=255)
     */
	private $nome;



    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}