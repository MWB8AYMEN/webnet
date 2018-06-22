<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as REST;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Produit;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @REST\RouteResource("Produit")
 * @REST\NamePrefix("api_")
 */
class ProduitController extends FOSRestController
{
    /**
     * List Produits Catgeory
     *
     * @ParamConverter("category", options={"mapping": {"category"   : "name"}})
     * @REST\Route(path="/categories/{category}/products", methods={"GET","POST"})
     * @param Request $request
     * @return mixed
     */
    public function showAction(Request $request, Category $category)
    {
        $em = $this->getDoctrine();

        $produitRepositoty = $em->getRepository(Produit::class);

        $produits = $produitRepositoty->getProduitsCategory($category);

        return new JsonResponse($produits);
    }

    /**
     * Create New Produit
     *
     * @REST\Route(methods={"POST"})
     *
     * @return JsonResponse
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $nameProduit = $request->request->get('name');

        $stockProduit = $request->request->get('stock');

        $prixProduit = $request->request->get('prix');

        $categories = $request->request->get('association');

        $catRepositoty = $em->getRepository(Category::class);

        foreach ($categories as $categorie) {
            $newCategories[] = $catRepositoty->findOneBy(array('name'=>$categorie));
        }

        $produit = new Produit();

        $produit->setName($nameProduit);

        $produit->setStock($stockProduit);

        $produit->setPrix($prixProduit);

        $produit->setAssociation($categories);

        $em->persist($produit);

        $em->flush();

        return new JsonResponse(array('new produit' =>$nameProduit));
    }
}
