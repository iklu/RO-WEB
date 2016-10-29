<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient(array(), array('HTTP_HOST' => 'localhost'));
        $client->followRedirects(true);


        //$crawler = $client->request('GET', '/');
    }

}
