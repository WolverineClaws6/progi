<?php

namespace App\Controller;

use App\Entity\CarType;
use App\Entity\FeeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InitController extends BaseController {

	#[Route('/init', name: 'init')]
    public function init(EntityManagerInterface $em): Response {

		// List of all the classes to initiate in order of dependencies
		$input = array(
			CarType::class,
			FeeType::class,

			// Add any new class to initiate here
		);

		// Initiate the output object
		$output = (object) array();

		// For each class
		foreach ($input as $classname) {

			// Grab the Repository of this class
			$repo = $em->getRepository($classname);

			// Get the Entity Name
			$entityName = str_replace("App\Entity\\", "", $classname);

			// Initiate the Class
			$return = $repo->createAll();

			// If something was created
			if ($return) {

				// Add the result to the output object
				$output->$entityName = $return;
			}
		}

		// If the output object is not empty
		if (!empty((array) $output)) {

			// flush everything at once
			$em->flush();
		}

		return $this->render("admin/init.html.twig", array(
			"output" => $output,
		));
    }

}
