<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/6/29
 * Time: 上午1:31
 */

namespace AppBundle\Controller;


use AppBundle\Entity\GenusNote;
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
          $genus->setSubFamily('Octopodinae');
          $genus->setSpeciesCount(rand(100,99999));

          $genusNode = new GenusNote();
          $genusNode->setUsername('AquaWeaver');
          $genusNode->setUserAvatarFilename('ryan.jpeg');
          $genusNode->setNote('I counted 8 legs...As they wrapped around me.');
          $genusNode->setCreatedAt(new \DateTime('-1 month'));
          $genusNode->setGenus($genus);
          $em = $this->getDoctrine()->getManager();
          $em->persist($genus);
          $em->persist($genusNode);
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
        dump($em->getRepository('AppBundle:Genus'));
        $genuses = $em->getRepository('AppBundle:Genus')
//            ->findAll();
                ->findAllPublishedOrderBySize();
//          dump($genuses);exit;
        return $this->render('genus/list.html.twig',[
            'genuses'=>$genuses
        ]);

    }
    /**
     * @Route("/genus/{genusName}",name="genus_show")
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
        $em = $this->getDoctrine()->getManager();
        $genus = $em-> getRepository('AppBundle:Genus')
            ->findOneBy(['name'=>$genusName]);
        if(!$genus) {
            throw $this->createNotFoundException("No genus found!");
        }

//        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
//        $key = md5($funFact);
//        if($cache->contains($key)) {
//            $funFact = $cache->fetch($key);
//        } else {
//           sleep(1);
//            $funFact = $this->get('markdown.parser')
//                ->transform($funFact);
//            $cache->save($key,$funFact);
//        }
//        $funFact = $this->container->get('markdown.parser')
//            ->transform($funFact);
        $recentNotes = $em->getRepository('AppBundle:GenusNote')
            ->findAllRecentNotesForGenus($genus);
        return $this->render('genus/show.html.twig',[
            'notes'=>$notes,
//            'funFact'=>$funFact,
//            'name'=>$genusName
            'genus'=>$genus,
            'recentNoteCount'=>count($recentNotes)
        ]);
//        return new  Response("The Genus: ".$genusName);
    }

    /**
     * @Route("/genus/{name}/notes",name="genus_show_notes")
     * @Method("GET")
     */
    public function getNotesAction(Genus $genus)
    {
        $notes = [];
        $notes = $genus->getNotes();
        foreach ($genus->getNotes() as $note) {
            $notes[] = [
                'id'=>$note->getId(),
                'username'=>$note->getUsername(),
                'avagarUrI'=>$note->getUserAvatarFilename(),
                'note'=>$note->getNote(),
                'date'=>$note->getCreatedAt()->format('M d,Y')
            ];
        }
        $data = [
            'notes'=>$notes
        ];
//        return new Response(json_encode($data));
        return new JsonResponse($data);
    }
}