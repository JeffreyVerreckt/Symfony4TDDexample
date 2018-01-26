<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use App\DataFixtures\TicketFixtures;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TicketControllerTest extends WebTestCase
{

    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = $this->makeClient();
    }

    public function testViewTicket()
    {
        $this->loadFixtures([TicketFixtures::class]);

        $path = '/ticket/1';
        $crawler = $this->client->request('GET', $path);
        $this->assertStatusCode(200, $this->client); // Assert 200 OK

        $this->assertSame(1, $crawler->filter('html > body')->count());

        $content = $this->fetchContent($path);
        $this->assertContains('My First Ticket', $content);
    }

    public function testViewTicketNotFound()
    {
        $this->loadFixtures([]);
        $path = '/ticket/1';
        $this->client->request('GET', $path);
        $this->assertStatusCode(404, $this->client);
    }

    public function testShowAddTicket()
    {
        $this->client->request('GET', '/ticket/add');
        $this->assertStatusCode(200, $this->client);
    }

    public function testAddTicketNotAllRequiredFieldsFilledIn()
    {
        $crawler = $this->client->request('GET', '/ticket/add');
        $form = $crawler->selectButton('Submit')->form();
        $this->client->submit($form);

        $this->assertStatusCode(200, $this->client);
        $this->assertValidationErrors(['children[subject].data'], $this->client->getContainer());
    }

    public function testAddTicketWithAllRequiredFieldsFilledIn()
    {
        $crawler = $this->client->request('GET', '/ticket/add');
        $this->assertStatusCode(200, $this->client);

        $form = $crawler->selectButton('Submit')->form();
        $form->setValues(['ticket[subject]' => 'My ticket', 'ticket[description]' => 'My ticket description.']);
        $this->client->submit($form);
        // Todo: finish test
    }
}
