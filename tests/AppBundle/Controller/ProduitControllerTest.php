<?php

namespace Tests\AppBundle\Controller;

use Proxies\__CG__\AppBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{


    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    //phpunit -c app/  Tests\AppBundle\Controller\ProduitControllerTest
    /**
     * @dataProvider produitProvider
     */
    public function testGetProduitsCategoryList($cat)
    {
        $client = static::createClient();
        $category = 'categorie1';
        $client->request('GET', '/api/categories/'.$category.'/products');
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertTrue(200 === $response->getStatusCode());
        $this->assertJson($content);;
        $jsonResponse = json_decode($content, true);

        $this->assertContains($cat, array_values(array_column(json_decode($content),'name')));

    }


    public function produitProvider()
    {
        return [
            ['produit 1', 'produit 2']
        ];
    }


}