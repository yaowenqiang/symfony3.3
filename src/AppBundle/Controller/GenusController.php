<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/6/29
 * Time: 上午1:31
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use \Symfony\Component\HttpFoundation\Response;

class GenusController
{
    /**
     * @Route("/genus/{genusName}")
     */
    public function showAction($genusName)
    {
        //octopus
        return new  Response("The Genus: ".$genusName);
    }
}