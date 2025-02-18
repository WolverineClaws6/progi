<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;


class BaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass = "")
    {
        parent::__construct($registry, $entityClass);
    }

	public function getEM():EntityManagerInterface
	{
		return $this->getEntityManager();
	}

	public function createIfNotExist(string $class, array $fields, array $array): ?object {
			$em = $this->getEM();

			if (!$this->findOneBy(array_combine($fields, $array))) {
				$entity = new $class(...$array);
				$em->persist($entity);
				return $entity;
			}
			return null;
	}


}
