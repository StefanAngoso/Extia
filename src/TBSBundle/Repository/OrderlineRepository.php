<?php

namespace TBSBundle\Repository;

/**
 * OrderlineRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OrderlineRepository extends \Doctrine\ORM\EntityRepository
{

	public function findOrderlines()
    {
        $query = $this->getEntityManager()
                        ->createQuery("
	            SELECT ol FROM TBSBundle:Orderline ol, TBSBundle:Basket b WHERE ol.bId = b.bId AND b.bStatus LIKE 'sent'"
                        );
        //$query->setParameter('b_id', $bId.'%');
        return $query->getResult();
    }

    public function countOrderlines($bId)
    {
        $query = $this->getEntityManager()
                        ->createQuery("
	            SELECT COUNT(ol) FROM TBSBundle:Orderline ol WHERE ol.bId = $bId"
                        );
        //$query->setParameter('b_id', $bId.'%');
        return $query->getSingleScalarResult();
    }

    public function findOrderlinesbyId($Id)
    {
        $query = $this->getEntityManager()
                        ->createQuery("
                SELECT ol FROM TBSBundle:Orderline ol, TBSBundle:Basket b WHERE ol.bId = b.bId AND b.id = $Id"
                        );
        return $query->getResult();
    }

    

}
