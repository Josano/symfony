<?php

namespace Code\CarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormBuilderInterface;

class CarroType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('fabricante')
			->add('modelo', 'text')
			->add('ano', 'number')
			->add('cor', 'text')						
			;
	}

	public function getName()
	{
		return "code_carbundle_carrotype";
	}
}