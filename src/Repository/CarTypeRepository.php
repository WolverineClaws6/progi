<?php

namespace App\Repository;

use App\Entity\CarType;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarType>
 */
class CarTypeRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarType::class);
    }

   public function createAll(): array {
		$output = array();
		$input = array(
			array("regular"),
			array("luxurious"),
		);

		foreach ($input as $data) {
			$this->createIfNotExist(CarType::class, array("name"), $data);
			$output[] = $data;
		}

		return $output;
	}

}
