<?php
namespace App\Tests\Entity;


use App\Entity\Ticket;
use PHPUnit\Framework\TestCase;

class TicketTest extends TestCase
{

    public function testGetterAndSetter()
    {
        $ticket = new Ticket();

        $this->assertNull($ticket->getId());

        $subject = 'My First Ticket';
        $ticket->setSubject($subject);
        $this->assertEquals($subject, $ticket->getSubject());

        $description = 'My description';
        $ticket->setDescription($description);
        $this->assertEquals($description, $ticket->getDescription());
    }
}