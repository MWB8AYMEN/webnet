<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Produit;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends EntityRepository
{
    public function getProduitsCategory($category){

        return $this->createQueryBuilder('p')
            ->select('p.name','p.stock','p.prix')
            ->where('p.association = :category')
            ->setParameter('category', $category)
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

}
