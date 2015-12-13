<?php

namespace Gnkw\GnkwBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Parsedown;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $pages = $this->get('kernel')->getRootDir() . '/../pages';
        $path = $pages . '/index.md';
        if(!is_file($path))
        {
            throw $this->createNotFoundException('Cette page n\'existe pas');
        }
        $text = file_get_contents($path);
        $html = Parsedown::instance()->text($text);
        return array('html' => $html);
    }
}
