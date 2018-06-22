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
        $cat = $category->getName();
       // dump((array)$cat);exit;
        $qb =  $this->createQueryBuilder('p');
        $results = $qb->select('p.name', 'p.stock', 'p.prix')
            ->where($qb->expr()->like('p.association', $qb->expr()->literal("%$cat%")))
            ->orderBy('p.id', 'ASC')
            ->getQuery()
            ->getResult();

        return $results;
    }

}
