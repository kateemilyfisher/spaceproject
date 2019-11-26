<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use App\Entity\SpaceStation;
use App\Entity\Astronaut;
use App\Entity\Position;
use App\Repository\SpaceStationRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;




class GetDataCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:get-data';
    private $em;

    public function __construct(ObjectManager $manager, EntityManagerInterface $em){
        $this->manager = $manager;
        $this->em = $em;

        parent::__construct();
    }

    protected function configure()
    {
      $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Fetches the latest API data.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
      $spaceStationRepo = $this->em->getRepository('App:SpaceStation');
      $astronautRepo = $this->em->getRepository('App:Astronaut');

      $people = $this->getPeopleInSpace();

      $crafts = array_unique(array_column($people['people'], 'craft'));
      foreach ($crafts as $craft) {
         // check with the repository if already in the database
      if (empty($spaceStationRepo->findByCraft($craft)) ) {
           $spaceStation = new SpaceStation();
           $spaceStation->setName($craft);
           $this->manager->persist($spaceStation);
         }
       }
       $this->manager->flush();

      foreach ($people['people'] as $person) {
      if (empty($astronautRepo->findByAstronaut($person))) {
         $astronaut = new Astronaut();
         $spaceStationOfThisAstronaut = $spaceStationRepo->findOneBy(['name' => $person['craft']]);
         $astronaut->setSpaceStation($spaceStationOfThisAstronaut);
         $astronaut->setName($person['name']);
         $this->manager->persist($astronaut);
        }
      }
      $this->manager->flush();

      $spaceStationPosition = $this->getSpaceStationPosition();
      

      $latitude = $spaceStationPosition['iss_position']['latitude'];
      $longitude = $spaceStationPosition['iss_position']['longitude'];
      $timeStamp = $spaceStationPosition['timestamp'];
      $position = new Position();
      $position->setLatitude($latitude);
      $position->setLongitude($longitude);
      $position->setTimestamp($timeStamp);
      $this->manager->persist($position);
      $this->manager->flush();
    }

    private function getPeopleInSpace() {
      $request = curl_init();
      $url = "http://api.open-notify.org/astros.json";

      curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($request, CURLOPT_URL, $url);

      $response = curl_exec($request);
      curl_close($request);

      return json_decode($response, true);
    }

    private function getSpaceStationPosition() {
      $request = curl_init();
      $url = "http://api.open-notify.org/iss-now.json";

      curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($request, CURLOPT_URL, $url);

      $response = curl_exec($request);
      curl_close($request);

      return json_decode($response, true);
    }
}
?>
