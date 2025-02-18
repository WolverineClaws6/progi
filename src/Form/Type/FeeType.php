<?php

namespace App\Form\Type;

use App\Entity\CarType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

class FeeType extends AbstractType {

	private TranslatorInterface $translator;

	public function __construct(TranslatorInterface $translator) {
		$this->translator = $translator;
	}

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('category', EntityType::class, array(
				"attr"=>array(
					"v-model"=>"category",
				),
				'class' => CarType::class,
				'choice_label' => function (CarType $c) {
					return $this->translator->trans($c->getName());
				},
				'placeholder' => "placeholder",
			))
			->add('price', TextType::class, array(
				"attr"=>array(
					"v-model"=>"price",
				),
			))
			->add('fees', FeeTypeType::class, array(
				'label' => false,
				'fees' => $options['fees'],
			))
			->add('total', TextType::class, array(
				"attr"=>array(
					"v-model"=>"total",
					"readonly" => true,
				)
			))
		;
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults(array(
			'fees' => null,
			"csrf_protection" =>false,
		));
	}
}
