<?php

namespace Anticom\KennzeichenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AnticomKennzeichenBundle:Default:index.html.twig');
    }
}
