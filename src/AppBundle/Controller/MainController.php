<?php
/**
 * Created by PhpStorm.
 * User: leaphu
 * Date: 2017/7/6
 * Time: 上午2:10
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}