<?php

namespace App\Tests\Service;

use App\Entity\Ticket;
use App\Repository\TicketRepositoryInterface;
use App\Service\TicketService;
use PHPUnit\Framework\TestCase;

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
        $ticketService = new TicketService($ticketRepository);
        $ticket = $ticketService->getTicketById($ticketId);

        $this->assertEquals($ticket->getId(), $ticketId);
        $this->assertEquals($ticket->getSubject(), $ticketSubject);
    }
}