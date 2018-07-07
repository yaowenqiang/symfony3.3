<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Enqueue\Client\ProducerInterface;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    /**
     * @Route("/message/")
     */
    public function indexAction()
    {

        # WARN: 默认情况下使用的rabbitmq的默认交换机，且没有做持久化，
        $context = $this->container->get('enqueue.transport.context');
        $queue = $context->createQueue('process_image');

        $context->declareQueue($queue);

        $message = $context->createMessage("i am a message");

        $context->createProducer()->send($queue,$message);
        return new Response("message send");


    }

}
