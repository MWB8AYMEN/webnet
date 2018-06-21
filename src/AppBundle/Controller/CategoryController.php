<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @REST\RouteResource("category")
 * @REST\NamePrefix("api_")
 */
class CategoryController extends FOSRestController
{

    public function cgetAction()
    {
        return new Response('yeees');
        // replace this example code with whatever you need
        /*return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);*/
    }
}
