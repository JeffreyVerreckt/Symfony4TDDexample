<?php
namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TicketRepository
 * @package App\Repository
 */
final class TicketRepository implements TicketRepositoryInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ObjectRepository
     */
    private $repository;

    /**
     * TicketRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Ticket::class);
    }

    /**
     * @param int $id
     * @return Ticket
     */
    public function findById(int $id): ?Ticket
    {
        return $this->repository->find($id);
    }

    /**
     * @param Ticket $ticket
     */
    public function save(Ticket $ticket): void
    {
        $this->entityManager->persist($ticket);
        $this->entityManager->flush();
    }
}
