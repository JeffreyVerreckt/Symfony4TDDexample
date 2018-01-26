<?php
namespace App\Service;

use App\Entity\Ticket;
use App\Repository\TicketRepositoryInterface;

/**
 * Class Service
 * @package App\Service
 */
class TicketService implements TicketServiceInterface
{
    /**
     * @var TicketRepositoryInterface
     */
    private $ticketRepository;

    /**
     * TicketService constructor.
     * @param TicketRepositoryInterface $ticketRepository
     */
    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    /**
     * @param int $ticketId
     * @return Ticket
     */
    public function getTicketById(int $ticketId): ?Ticket
    {
        return $this->ticketRepository->findById($ticketId);
    }
}
