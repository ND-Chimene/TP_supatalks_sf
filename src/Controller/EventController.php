<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
    public function index(EventRepository $er): Response
    {
        return $this->render('event/index.html.twig', [
            'event' => $er->findAll(),
        ]);
    }
}
