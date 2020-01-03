<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityRepository;
use App\Repository\AstronautRepository;
use App\Repository\SpaceStationRepository;
use App\Entity\Position;



class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        //$em = $this->getEntityManager();
        $positionRepo = $this->getDoctrine()->getRepository('App:Position');
        $astronautRepo = $this->getDoctrine()->getRepository('App:Astronaut');
        $astronauts = $astronautRepo->findAll();

        $results = $positionRepo->findAll();

        // this needs fixing
        $position = new Position();
        $latitude = $position->getLatitude();
        $longitude = $position->getLongitude();


        return $this->render('index/index.html.twig', [
            'astronauts' => $astronauts,
            'positions' => $results,
            'controller_name' => 'IndexController',
        ]);
    }
}
