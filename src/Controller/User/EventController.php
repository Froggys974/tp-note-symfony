<?php

namespace App\Controller\User;

use App\Entity\Event;
use App\Form\EventForm;
use App\Repository\EventRepository;
use App\Repository\ParticipantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/event/', name: 'event_')]
#[IsGranted('ROLE_USER')]
class EventController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('pages/user/event.html.twig');
    }

    #[Route('invitations', name: 'invitations', methods: ['GET'])]
    public function invitations(ParticipantRepository $participantRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour voir vos invitations.');
            return $this->redirectToRoute('app_login');
        }

        $invitations = $participantRepository->findBy(['user' => $user]);

        return $this->render('pages/user/invitations_event.html.twig', [
            'invitations' => $invitations,
        ]);
    }

    #[Route('events', name: 'list', methods: ['GET'])]
    public function list(EventRepository $eventRepository, Request $request, FormFactoryInterface $formFactory): Response
    {
        $events = $eventRepository->findAll();
        $editForms = [];

        foreach ($events as $event) {
            $form = $formFactory->create(EventForm::class, $event, [
                'action' => $this->generateUrl('event_edit', ['id' => $event->getId()]),
                'method' => 'POST'
            ]);
            $editForms[$event->getId()] = $form->createView();
        }

        return $this->render('pages/user/list_event.html.twig', [
            'evenements' => $events,
            'forms' => $editForms,
        ]);
    }

    #[Route('my-events', name: 'my_events', methods: ['GET'])]
    public function myEvents(EventRepository $evenementRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour voir vos événements.');
            return $this->redirectToRoute('app_login');
        }

        $myEvents = $evenementRepository->findBy(['organizer' => $user]);

        return $this->render('pages/user/my_event.html.twig', [
            'myEvents' => $myEvents,
        ]);
    }


    #[Route('create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventForm::class, $event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $event->setOrganizer($this->getUser());
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash('success', 'Événement créé avec succès.');
            return $this->redirectToRoute('event_list');
        }

        return $this->render('pages/user/create_event.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('{id}', name: 'show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }
    #[Route('{id}', name: 'edit', methods: ['POST'])]
    public function edit(Event $event, Request $request, EntityManagerInterface $em): Response
    {
        if ($event->getOrganizer() !== $this->getUser()) {
            $this->addFlash('error', 'You are not the organizer of this event.');
            return $this->redirectToRoute('event_list');
        }

        $form = $this->createForm(EventForm::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'Event successfully updated.');
            return $this->redirectToRoute('event_list');
        }

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
            'event' => $event,
        ]);
    }


}
