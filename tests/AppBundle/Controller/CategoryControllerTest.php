<?php

namespace Tests\AppBundle\Controller;

use Proxies\__CG__\AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{


    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    //phpunit -c app/  Tests\AppBundle\Controller\CategoryControllerTest
    /**
     * @dataProvider categoryProvider
     */
    public function testGetCatgoriesList($cat)
    {
        $client = static::createClient();
        $client->request('GET', '/api/categories');
        $response = $client->getResponse();
        $content = $response->getContent();
        $this->assertTrue(200 === $response->getStatusCode());
        $this->assertJson($content);
        //dump(array_values(array_column(json_decode($content),'name')));
        $jsonResponse = json_decode($content, true);
        $this->assertContains($cat, array_values(array_column(json_decode($content),'name')));

    }


    public function categoryProvider()
    {
        return [
            ['category1'],
            ['category3']
        ];
    }


}