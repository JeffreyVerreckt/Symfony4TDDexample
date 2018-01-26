<?php
namespace App\Tests\Repository;

use App\DataFixtures\TicketFixtures;
use App\Repository\TicketRepositoryInterface;
use App\Tests\FixtureAwareTestCase;
use Doctrine\ORM\EntityManager;

class TicketRepositoryTest extends FixtureAwareTestCase
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var TicketRepositoryInterface
     */
    private $ticketRepository;

    public function setUp()
    {
        parent::setUp();

        $this->addFixture(new TicketFixtures());
        $this->executeFixtures();

        $kernel = static::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
        $this->ticketRepository = $kernel->getContainer()->get('test.App\Repository\TicketRepository');
    }

    public function testFindById()
    {
        $ticketId = 1;
        $ticketSubject = 'My First Ticket';

        $ticket = $this->ticketRepository->findById($ticketId);

        $this->assertEquals($ticketId, $ticket->getId());
        $this->assertEquals($ticketSubject, $ticket->getSubject());
    }
}
