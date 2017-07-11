<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/12
 * Time: 上午2:27
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class GenusRepository extends EntityRepository
{
    /*
     * @return Genus[]
     */
    public function findAllPublishedOrderBySize()
    {
       return $this->createQueryBuilder('genus')
           ->where('genus.isPublished = :isPublished')
           ->setParameter('isPublished',true)
           ->orderBy('genus.speciesCount','DESC')
           ->getQuery()
           ->execute();
//           ->getOneOrNullResult();
    }
}