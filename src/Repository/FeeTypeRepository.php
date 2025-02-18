<?php

namespace App\Repository;

use App\Entity\FeeType;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FeeType>
 */
class FeeTypeRepository extends BaseRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FeeType::class);
    }

	 public function createAll(): array {
		$output = array();
		$input = array(
			array("base"),
			array("special"),
			array("association"),
			array("storage"),
		);

		foreach ($input as $data) {
			$this->createIfNotExist(FeeType::class, array("name"), $data);
			$output[] = $data;
		}

		return $output;
	}
}
