<?php
namespace App\Service;

use App\Entity\Ticket;
use App\Event\TicketEvent;
use App\Repository\TicketRepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class Service
 * @package App\Service
 */
final class TicketService implements TicketServiceInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var TicketRepositoryInterface
     */
    private $ticketRepository;

    /**
     * TicketService constructor.
     * @param EventDispatcherInterface $eventDispatcher
     * @param TicketRepositoryInterface $ticketRepository
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, TicketRepositoryInterface $ticketRepository)
    {
        $this->eventDispatcher = $eventDispatcher;
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

    /**
     * @param Ticket $ticket
     */
    public function create(Ticket $ticket): void
    {
        $this->ticketRepository->save($ticket);
        $this->eventDispatcher->dispatch(TicketEvent::CREATED, new TicketEvent($ticket));
    }
}
