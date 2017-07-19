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
//    public function findAllPublishedOrderBySize()
    public function findAllPublishedOrderByRecentlyActive()
    {
       return $this->createQueryBuilder('genus')
           ->andWhere('genus.isPublished = :isPublished')
           ->setParameter('isPublished',true)
//           ->orderBy('genus.speciesCount','DESC')
           ->leftJoin('genus.notes','genus_note')
           ->orderBy('genus_note.createdAt','DESC')
           ->getQuery()
           ->execute();
//           ->getOneOrNullResult();
    }
}