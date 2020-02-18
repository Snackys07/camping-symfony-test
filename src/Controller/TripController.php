<?php

namespace App\Controller;

use App\Entity\{
    Emplacement,
    Sejour
};
use App\Form\TripsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{
    RedirectResponse,
    Request,
    Response
};
use Symfony\Component\Routing\Annotation\Route;

class TripController extends AbstractController
{
    /**
     * @Route("/trip/add/{id}", name="add_trip")
     * @param $id
     * @param Request $request
     * @return Response
     */
    public function add($id, Request $request): Response
    {
        $emplacement = $this->getDoctrine()->getRepository(Emplacement::class)->find($id);
        $trip = (new Sejour())
            ->setEmplacement($emplacement)
            ->setStatus('reserved');

        $createTrip = $this->createForm(TripsType::class, $trip);
        $createTrip->handleRequest($request);

        if ($createTrip->isSubmitted() && $createTrip->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trip);
            $entityManager->flush();

            $response = new RedirectResponse('/locations');
            $response->prepare($request);

            return $response->send();
        }

        return $this->render('trip/add_trip.html.twig', [
            'form' => $createTrip->createView()
        ]);
    }

    /**
     * @Route("/trip/{emplacementId}", name="trip")
     * @param $emplacementId
     * @return Response
     */
    public function show($emplacementId)
    {
        $trips = $this->getDoctrine()
            ->getRepository(Sejour::class)
            ->findBy(['emplacement' => $emplacementId]);

        return $this->render('trip/index.html.twig', [
            'trips' => $trips,
            'emplacementId' => $emplacementId
        ]);
    }
}
