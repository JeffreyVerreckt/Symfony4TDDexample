<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\TicketType;
use App\Service\TicketServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TicketController
 * @package App\Controller
 */
final class TicketController extends Controller
{

    /**
     * @var TicketServiceInterface
     */
    private $ticketService;

    /**
     * TicketController constructor.
     * @param TicketServiceInterface $ticketService
     */
    public function __construct(TicketServiceInterface $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    /**
     * @Route("/ticket/add", name="ticket_add")
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Form\Exception\LogicException
     */
    public function addAction(Request $request): Response
    {
        $ticket = new Ticket(); // Todo: Refactor to use a factory
        $form = $this->createForm(TicketType::class, $ticket);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ticket = $form->getData();
            $this->ticketService->create($ticket);
        }

        return $this->render('ticket/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ticket/{ticketId}", name="ticket_view"), requirements={ticketId: "\d+"}
     * @param $ticketId
     * @return Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function viewAction($ticketId): Response
    {
        $ticket = $this->ticketService->getTicketById($ticketId);

        if (!$ticket) {
            throw $this->createNotFoundException('Ticket with Id '.$ticketId.' was not found!');
        }

        return $this->render('ticket/view.html.twig', [
            'ticket' => $ticket,
        ]);
    }
}
