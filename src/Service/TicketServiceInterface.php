<?php

namespace App\Service;

use App\Entity\Ticket;

/**
 * Interface TicketServiceInterface
 * @package App\Service
 */
interface TicketServiceInterface
{
    /**
     * @param int $ticketId
     * @return Ticket
     */
    public function getTicketById(int $ticketId): ?Ticket;
}
