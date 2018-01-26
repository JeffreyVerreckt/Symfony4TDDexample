<?php
namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TicketRepository
 * @package App\Repository
 */
class TicketRepository implements TicketRepositoryInterface
{

    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $repository;

    /**
     * TicketRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
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
}
