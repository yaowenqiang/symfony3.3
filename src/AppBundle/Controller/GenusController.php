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
use AppBundle\Entity\Genus;

class GenusController extends Controller
{
    /**
     * @Route("/genus/new")
     */
    public function newAction()
    {
          $genus = new Genus();
          $genus->setName('Octopus'.rand(1,100));
          $genus->setSubFaminy('Octopodinae');
          $genus->setSpeciesCount(rand(100,99999));

          $em = $this->getDoctrine()->getManager();
          $em->persist($genus);
          $em->flush();
          return new Response("<html><body>Genus Created</body></html>");
    }

    /**
     * @Route("/genus/")
     */
    public function listAction()
    {
          $em = $this->getDoctrine()->getManager();
//          $genus = $em->getRepository('AppBundle\Entity\Genus')
//              ->findAll();
        $genuses = $em->getRepository('AppBundle:Genus')
            ->findAll();
//          dump($genuses);exit;
        return $this->render('genus/list.html.twig',[
            'genuses'=>$genuses
        ]);

    }
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
        $funFact = "Octopuses can change the color of their body in just *three-tenths* of a second!";
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($funFact);
        if($cache->contains($key)) {
            $funFact = $cache->fetch($key);
        } else {
           sleep(1);
            $funFact = $this->get('markdown.parser')
                ->transform($funFact);
            $cache->save($key,$funFact);
        }
//        $funFact = $this->container->get('markdown.parser')
//            ->transform($funFact);
        return $this->render('genus/show.html.twig',[
            'notes'=>$notes,
            'funFact'=>$funFact,
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
        ];
        $data = [
            'notes'=>$notes
        ];
//        return new Response(json_encode($data));
        return new JsonResponse($data);
    }
}