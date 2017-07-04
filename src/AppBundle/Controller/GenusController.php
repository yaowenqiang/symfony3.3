<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/6/29
 * Time: 上午1:31
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
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
        $notes = [
            "Octopus asked me a riddle,outsmarted me",
            'I counted 8 legs...as they wrapped around me',
            'Inked!'
        ];
        return $this->render('genus/show.html.twig',[
            'notes'=>$notes,
            'name'=>$genusName
        ]);
//        return new  Response("The Genus: ".$genusName);
    }

    /**
     * @Route("/genus/{genusName}/notes",name="genus_show_notes")
     * @Method("GET")
     */
    public function getNotesAction()
    {
        $notes = [
            ['id'=>1,'username'=>'AquaPelham','avatarUrl'=>'/images/leanna.jpeg','note'=>"Octopus asked me a riddle,outsmarted me",'date'=>"Dec,10,2012"]
            ['id'=>2,'username'=>'AquaPelham','avatarUrl'=>'/images/leanna.jpeg','note'=>"a new note",'date'=>"Dec,10,2012"]
        ];
        $data = [
            'notes'=>$notes
        ];
//        return new Response(json_encode($data));
        return new JsonResponse($data);
    }
}