<?php

namespace App\Controller;

use App\Entity\Sejour;
use App\Form\{
    Data\HomeSearchData,
    HomeSearchType
};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {

        $homeSearchData = new HomeSearchData();

        $form = $this->createForm(HomeSearchType::class, $homeSearchData, ['attr' => ['novalidate' => 'novalidate']]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $this->getDoctrine()->getRepository(Sejour::class)->homeSearch($homeSearchData);
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'data' => $data ?? null
        ]);
    }
}
