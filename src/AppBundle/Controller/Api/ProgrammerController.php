<?php


namespace AppBundle\Controller\Api;


use AppBundle\Entity\Programmer;
use AppBundle\Form\ProgrammerType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammerController extends Controller
{
/**
     * @Route("/api/programmers")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $body = $request->getContent();
        $data = json_decode($body, true);
        $programmer = new Programmer();
        $form = $this->createForm(ProgrammerType::class, $programmer,[
            'csrf_protection'=>false
        ]);
        $form->submit($data);
//        $programmer->setUser($this->findUserByusername(['weareryyan']));
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($programmer);
//        $em->flush();

        $response =  new Response('It worked, Believe me I am an API', 201);
        $response->headers->set('Location', "/some/programmer");
        return $response;
    }

}