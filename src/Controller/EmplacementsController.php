<?php

namespace App\Controller;

use App\Entity\Emplacement;
use App\Form\{
    EditLocationType,
    EmplacementsType
};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{
    RedirectResponse,
    Request,
    Response
};
use Symfony\Component\Routing\Annotation\Route;

class EmplacementsController extends AbstractController
{
    /**
     * @Route("/locations/add", name="add_location")
     */
    public function add(Request $request): Response
    {
        $locations = new Emplacement();
        dump($locations);

        $createLocation = $this->createForm(EmplacementsType::class, $locations, [
            'attr' => ['novalidate' => 'novalidate']
        ]);

        $createLocation->handleRequest($request);
        dump($createLocation);

        if ($createLocation->isSubmitted() && $createLocation->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($locations);
            $entityManager->flush();
            $response = new RedirectResponse('/locations');
            $response->prepare($request);

            return $response->send();
        }

        return $this->render('emplacements/addEmplacement.html.twig', [
            'form' => $createLocation->createView()
        ]);
    }

    /**
     * @Route("/locations", name="locations")
     */
    public function show()
    {

        $repository = $this->getDoctrine()->getRepository(Emplacement::class);

        $locations = $repository->findAll();

        return $this->render('emplacements/index.html.twig', [
            'locations' => $locations
        ]);
    }

    /**
     * @Route("/locations/edit/{id}", name="edit_location")
     * @param Emplacement $location
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return RedirectResponse|Response
     */
    public function update(Emplacement $location, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(EditLocationType::class, $location, ['attr' => ['novalidate' => 'novalidate']]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($location);
            $em->flush();

            $this->addFlash('success', 'Location updated!');

            return $this->redirectToRoute('locations');
        }

        return $this->render('emplacements/editLocation.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/locations/delete/{id}", name="delete_location")
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $location = $entityManager->getRepository(Emplacement::class)->find($id);

        $entityManager->remove($location);
        $entityManager->flush();

        return new RedirectResponse('/locations');
    }
}
