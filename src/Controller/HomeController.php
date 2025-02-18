<?php

namespace App\Controller;

use App\Entity\FeeType;
use App\Form\Type\FeeType as FeeTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends BaseController {

	#[Route('/', name: 'showHome')]
    public function showHome(EntityManagerInterface $em): Response {

		$feeTypeRepo =$em->getRepository(FeeType::class);
		$feeTypes = $feeTypeRepo->findAll();
		
		$form = $this->createForm(FeeTypeForm::class, null, array('fees'=>$feeTypes));
		
        return $this->render("home.html.twig", array(
			"form" => $form->createView(),
		));
    }

}
