<?php

namespace Code\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Table("carro")
 *@ORM\Entity(repositoryClass="Code\CarBundle\Entity\CarroRepository") 
 */
class Carro
{

    /**
     * @ORM\Column(type="integer", length=11)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

     /**
     * @ORM\Column(name="modelo", type="string", length=255)
     */ 
    private $modelo;

    /**
     * @ORM\Column(type="integer", length=11)
     */     
    private $ano;

     /**
     * @ORM\Column(name="cor", type="string", length=50)
     */     
    private $cor;

    /**
     * @ORM\ManyToOne(targetEntity="Code\CarBundle\Entity\Fabricante", inversedBy="carros")
     * @ORM\JoinColumn(name="fabricante_id", referencedColumnName="id")
     **/
    private $fabricante_id;

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
     * Gets the value of modelo.
     *
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Sets the value of modelo.
     *
     * @param mixed $modelo the modelo
     *
     * @return self
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Gets the value of ano.
     *
     * @return mixed
     */
    public function getAno()
    {
        return $this->ano;
    }

    /**
     * Sets the value of ano.
     *
     * @param mixed $ano the ano
     *
     * @return self
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Gets the value of cor.
     *
     * @return mixed
     */
    public function getCor()
    {
        return $this->cor;
    }

    /**
     * Sets the value of cor.
     *
     * @param mixed $cor the cor
     *
     * @return self
     */
    public function setCor($cor)
    {
        $this->cor = $cor;

        return $this;
    }

    /**
     * Gets the value of fabricante_id.
     *
     * @return mixed
     */
    public function getFabricante_id()
    {
        return $this->fabricante_id;
    }

    /**
     * Sets the value of fabricante_id.
     *
     * @param mixed $fabricante_id the fabricante_id
     *
     * @return self
     */
    public function setFabricante_id($fabricante_id)
    {
        $this->fabricante_id = $fabricante_id;

        return $this;
    }
}