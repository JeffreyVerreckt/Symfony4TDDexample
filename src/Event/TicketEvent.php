<?php

namespace App\Event;

use App\Entity\Ticket;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class TicketEvent
 * @package App\Event
 */
final class TicketEvent extends Event
{
    public CONST CREATED = 'ticket.created';

    /**
     * @var Ticket
     */
    private $ticket;

    /**
     * TicketEvent constructor.
     * @param Ticket $ticket
     */
    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    /**
     * @return Ticket
     */
    public function getTicket(): Ticket
    {
        return $this->ticket;
    }
}
