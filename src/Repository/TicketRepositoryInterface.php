<?php

namespace App\Repository;

use App\Entity\Ticket;

/**
 * Interface TicketRepositoryInterface
 * @package App\Repository
 */
interface TicketRepositoryInterface
{
    /**
     * @param int $id
     * @return Ticket
     */
    public function findById(int $id): ?Ticket;

    /**
     * @param Ticket $ticket
     */
    public function save(Ticket $ticket): void;
}
