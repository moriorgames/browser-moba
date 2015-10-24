<?php

namespace AppBundle\Tests\Admin;

use CoreBundle\Tests\Traits\LoginTrait;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardTest extends WebTestCase
{
    use LoginTrait;

    /**
     * @var Client
     */
    private $client = null;

    public function setUp()
    {
        $this->client = $this->loginAsAdmin();
    }

    public function testDashboardRender()
    {
        $crawler = $this->client->request('GET', '/admin/dashboard');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        $this->assertContains('Admin Panel', $this->client->getResponse()->getContent());
    }
}
