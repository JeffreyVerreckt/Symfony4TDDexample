<?php

namespace App\Tests\Service;

use App\Entity\Ticket;
use App\Event\TicketEvent;
use App\Repository\TicketRepositoryInterface;
use App\Service\TicketService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;

class TicketServiceTest extends TestCase
{

    public function testTicketById()
    {
        $ticketId = 1;
        $ticketSubject = 'My ticket';

        // Create our ticket to assert
        $ticket = new Ticket();
        $ticket->setId($ticketId);
        $ticket->setSubject($ticketSubject);

        $ticketRepository = $this->createMock(TicketRepositoryInterface::class);
        $ticketRepository->expects($this->any())
            ->method('findById')
            ->willReturn($ticket);

        // Get ticketById from our service
        $ticketService = new TicketService(new EventDispatcher(), $ticketRepository);
        $ticket = $ticketService->getTicketById($ticketId);

        $this->assertEquals($ticket->getId(), $ticketId);
        $this->assertEquals($ticket->getSubject(), $ticketSubject);
    }

    public function testCreate()
    {
        $ticketId = 1;
        $ticketSubject = 'My ticket';

        $ticket = new Ticket();
        $ticket->setId($ticketId);
        $ticket->setSubject($ticketSubject);

        $ticketRepository = $this->createMock(TicketRepositoryInterface::class);
        $ticketRepository->expects($this->once())
            ->method('save')
            ->willReturn($ticket);

        $ticketService = new TicketService(new EventDispatcher(), $ticketRepository);
        $ticketService->create($ticket);

        $this->assertEquals($ticket->getId(), $ticketId);
    }

    public function testCreateEvent()
    {
        $ticketId = 1;
        $ticketSubject = 'My ticket';

        $ticket = new Ticket();
        $ticket->setId($ticketId);
        $ticket->setSubject($ticketSubject);

        $ticketRepository = $this->createMock(TicketRepositoryInterface::class);
        $ticketRepository->method('save');

        $dispatcher = new EventDispatcher();
        $dispatchedEvent = null;
        $dispatcher->addListener(TicketEvent::CREATED, function ($event) use (&$dispatchedEvent) {
            $dispatchedEvent = $event;
        });

        $ticketService = new TicketService($dispatcher, $ticketRepository);
        $ticketService->create($ticket);

        $this->assertEquals(new TicketEvent($ticket), $dispatchedEvent);
        $this->assertEquals($ticket, $dispatchedEvent->getTicket());
    }
}