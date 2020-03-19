<?php


namespace AppBundle\Controller\Api;


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
    public function newAction()
    {
        return new Response("Let's do this");
    }

}