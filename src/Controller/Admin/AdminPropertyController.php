<?php

namespace App\Controller\Admin;

use App\Entity\Option;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AdminPropertyController extends AbstractController
{

    private $repository;
    private $em;


    public function __construct(PropertyRepository $repository,EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route ("/admin", name="admin.property.index")
     * @return void
     */
    public function index()
    {
        $properties = $this->repository->findAll(); 
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }

    /**
     * @Route ("/admin/property/create", name="admin.property.new")
     * @return void
     */
    public function new(Request $request) 
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($property);
            $this->em->flush();
            $this->addFlash('success','Bien créé avec succes');

            return $this->redirectToRoute('admin.property.index');
        }
            return $this->render('admin/property/new.html.twig', [
                'property' => $property,
                'form' => $form->createView()
            ]);
        }
    
    /**
     * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @return void
     */
    public function edit(Property $property, Request $request)
    {   
        
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success','Bien modifié avec succes');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route ("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @return void
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getID(), $request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success','Bien supprimé avec succes');

        }
        return $this->redirectToRoute('admin.property.index');

    }
}