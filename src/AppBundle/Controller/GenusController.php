<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/6/29
 * Time: 上午1:31
 */

namespace AppBundle\Controller;


use AppBundle\Entity\GenusNote;
use AppBundle\Entity\user;
use AppBundle\Service\MarkdownTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Genus;
use Symfony\Component\HttpFoundation\Tests\DefaultResponse;

class GenusController extends Controller
{
    /**
     * @Route("/create", name="create")
     */
    public function createNewAction()
    {
        $genus = new Genus();
        $genus->setName("Octopus" . rand(1,100));
        $genus->setSubFamily("null");
        $genus->setSpeciesCount(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->flush();
        return new Response("<html><body>Genus created!</body></html>");
    }

    /**
     * @Route("/genus/new")
     */
    public function newAction()
    {
        $genus = new Genus();
        $genus->setName('Octopus' . rand(1, 100));
        $genus->setSubFamily('Octopodinae');
        $genus->setSpeciesCount(rand(100, 99999));

        $genusNote = new GenusNote();
        $genusNote->setUsername('AquaWeaver');
        $genusNote->setUserAvatarFilename('ryan.jpeg');
        $genusNote->setNote('I counted 8 legs...As they wrapped around me.');
        $genusNote->setCreatedAt(new \DateTime('-1 month'));
        $genusNote->setGenus($genus);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(user::class)
            ->findOneBy([
                'email' => 'aquanaut+1@163.com'
            ]);

        $genus->addGenusScientist($user);
        $genus->addGenusScientist($user);

        $em->persist($genus);
        $em->persist($genusNote);
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
            ->findAllPublishedOrderByRecentlyActive();
//          dump($genuses);exit;
        return $this->render('genus/list.html.twig', [
            'genuses' => $genuses
        ]);

    }

    /**
     * @Route("/genus/{slug}",name="genus_show")
     */
    public function showAction(genus $genus)
    {
        //octopus
        //make the var/cache directory excluded,because ths directory may make auto-completing not work correctly.
//        $templating = $this->container->get('templating');
//        $html = $templating->render('genus/show.html.twig',[
//            'name' => $genusName
//        ]);
//        return new Response($html);
        $this->get('logger')
            ->info('Showing genus: ' . $genus->getName());
        $notes = [
            "Octopus asked me a riddle,outsmarted me",
            'I counted 8 legs...as they wrapped around me',
            'Inked!'
        ];
        $funFact = "Octopuses can change the color of their body in just *three-tenths* of a second!";
        $em = $this->getDoctrine()->getManager();
//        $genus = $em->getRepository('AppBundle:Genus')
//            ->findOneBy(['name' => $genusName]);
//        if (!$genus) {
//            throw $this->createNotFoundException("No genus found!");
//        }
//        $transformer = new MarkdownTransformer(
//            $this->get('markdown.parser')
//        );
        $transformer = $this->get('app.markdown_transformer');
        $funFact = $transformer->parse($genus->getFunFact());

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
        return $this->render('genus/show.html.twig', [
            'notes' => $notes,
            'funFact' => $funFact,
//            'name'=>$genusName
            'genus' => $genus,
            'recentNoteCount' => count($recentNotes)
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
                'id' => $note->getId(),
                'username' => $note->getUsername(),
                'avagarUrI' => $note->getUserAvatarFilename(),
                'note' => $note->getNote(),
                'date' => $note->getCreatedAt()->format('M d,Y')
            ];
        }
        $data = [
            'notes' => $notes
        ];
//        return new Response(json_encode($data));
        return new JsonResponse($data);
    }

    /**
     * @Route("/users/{id}", name="user_show")
     */
    public function showUserAction(User $user)
    {
        return $this->render('user/show.html.twig', [
            'user'=>$user
        ]);
    }

    /**
     * @Route("/user/edit/id}", name="user_edit")
     */
    public function usereditAction(User $user)
    {

        return $this->render('user/edit.html.twig', [
            'user'=>$user
        ]);
    }


    /**
     * @Route("/genus/{genusId}/scientist/{userId}", name="genus_scientist_remove")
     * @Method("DELETE")
     */
    public function removeGenusScientistAction($genusId, $userId)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Genus $genus */
        $genus = $em->getRepository(Genus::class)
            ->find($genusId);
        if (!$genus) {
            throw $this->createNotFoundException('genus not found');
        }

        $genusScientist = $em->getRepository(user::class)
            ->find($userId);
        if (!$genusScientist) {
            throw $this->createNotFoundException('genus scientist not found');
        }

        $genus->removeGenusScientist($genusScientist);
        $em->persist($genus);
        $em->flush();

        return new Response(null, 200);

    }

}