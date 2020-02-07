<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityRepository;
use App\Repository\AstronautRepository;
use App\Repository\SpaceStationRepository;
use App\Repository\PictureRepository;
use App\Entity\Position;
use App\Entity\Picture;



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
        $pictureRepo = $this->getDoctrine()->getRepository('App:Picture');
        $astronauts = $astronautRepo->findAll();

        $results = $positionRepo->findAll();
        $pictureOfTheDay = $pictureRepo->findAll();

        // this needs fixing
        // $position = new Position();
        // $latitude = $position->getLatitude();
        // $longitude = $position->getLongitude();
        //
        // // why these no work
        // $pictureOfTheDay = new Picture();
        // $url = $pictureOfTheDay->getUrl();
        // $explanation = $pictureOfTheDay->getExplanation();
        // $date = $pictureOfTheDay->getDate();


        return $this->render('index/index.html.twig', [
            'astronauts' => $astronauts,
            'positions' => $results,
            'pictureOfTheDay' => $pictureOfTheDay,
            'controller_name' => 'IndexController',
        ]);
    }
}
