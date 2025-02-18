<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FeeTypeType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		foreach($options['fees'] as $fee){
			$builder->add($fee->getName(), TextType::class, array(
				'attr' => array(
					"v-model" => $fee->getName(),
					'readonly'=> true,
				),
			));
		}
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
			'fees' => null,
			"csrf_protection" =>false,
		));
	}
}
