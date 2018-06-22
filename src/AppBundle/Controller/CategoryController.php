<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;

/**
 * @REST\RouteResource("category")
 * @REST\NamePrefix("api_")
 */
class CategoryController extends FOSRestController
{
    /**
     * @return JsonResponse
     */
    public function cgetAction()
    {
        $em = $this->getDoctrine();

        $catRepositoty = $em->getRepository(Category::class);

        $categories = $catRepositoty->getAllCategories();

        return new JsonResponse($categories);
    }

    /**
     * Create New Catgeorie Produit
     *
     * @REST\Route(methods={"POST"})
     *
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $newCategory = $request->request->get('name');

        $category = new Category();

        $category->setName($newCategory);

        $em->persist($category);

        $em->flush();
        $catRepositoty = $em->getRepository(Category::class);

        $result = $catRepositoty->findOneBy(array('name'=>$newCategory));
        return new JsonResponse(array('result'=>$result->getName()));
    }
}
