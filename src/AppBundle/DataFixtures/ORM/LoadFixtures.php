<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/12
 * Time: 上午1:36
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Genus;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {


        $genus = new Genus();
        $genus->setName('Octopus'.rand(1,100));
        $genus->setSubFaminy('Octopodinae');
        $genus->setSpeciesCount(rand(100,99999));

        $manager->persist($genus);
        $manager->flush();
    }
}
