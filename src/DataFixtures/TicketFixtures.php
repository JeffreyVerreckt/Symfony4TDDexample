<?php

namespace App\DataFixtures;

use App\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class TicketFixtures
 * @package App\DataFixtures
 */
class TicketFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $ticket = new Ticket();
        $ticket->setSubject('My First Ticket');
        $ticket->setDescription('My first problem.');
        $manager->persist($ticket);

        $manager->flush();
    }
}