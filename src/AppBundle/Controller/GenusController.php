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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GenusController extends Controller
{
    /**
     * @Route("/genus/{genusName}")
     */
    public function showAction($genusName)
    {
        //octopus
        //make the var/cache directory excluded,because ths directory may make auto-completing not work correctly.
//        $templating = $this->container->get('templating');
//        $html = $templating->render('genus/show.html.twig',[
//            'name' => $genusName
//        ]);
//        return new Response($html);
        return $this->render('genus/show.html.twig',['name'=>$genusName]);
//        return new  Response("The Genus: ".$genusName);
    }
}