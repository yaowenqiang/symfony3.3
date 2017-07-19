<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/12
 * Time: 上午2:27
 */

namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Genus;

class GenusNoteRepository extends EntityRepository
{
    public function findAllRecentNotesForGenus(Genus $genus)
    {
        return $this->createQueryBuilder('genus_note')
            ->andWhere('genus_note.genus = :genus')
            ->setParameter('genus',$genus)
            ->andWhere('genus_note.createdAt > :recentDate')
            ->setParameter('recentDate',new \Datetime('-3 months'))
            ->getQuery()
            ->execute();
    }
}