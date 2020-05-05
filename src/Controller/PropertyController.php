<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController{
    
    
    /**
     * @var PropertyRepository
     */
    private $repository;
    private $objectManager;
    
    /**
     * @var ObjectManager
     */

        public function __construct(PropertyRepository $repository, ObjectManager $objectManager){

            $this->repository = $repository;
            $this->objectManager = $objectManager;

        }
        
    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        $property = $this->repository->FindAllVisible();
        $property[0]-> setSold(true);
        $this->em->flush();
        return $this->render('property/index.html.twig', ['current_menu' => 'properties']);     
    }
}