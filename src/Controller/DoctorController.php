<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Form\DoctorType;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\DoctorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/doctor")
 */
class DoctorController extends AbstractController
{
    /**
     * @Route("/", name="doctor_index", methods={"GET"})
     */
    public function index(DoctorRepository $doctorRepository): Response
    {
        return $this->render('doctor/index.html.twig', [
            'doctors' => $doctorRepository->findAll(),
        ]);
    }


/**
*@Route("/indexadmin",name="doctors_list")
*/
    public function homeadmin(Request $request)
    {
        $propertySearch = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$propertySearch);
        $form->handleRequest($request);
        //initialement le tableau des doctors est vide,
        //c.a.d on affiche les doctors que lorsque l'utilisateur
        //clique sur le bouton rechercher
        $doctors= [];

        if($form->isSubmitted() && $form->isValid()) {
            //on récupère le nom de specialité tapé dans le formulaire
            $speciality = $propertySearch->getSpeciality();
            if ($speciality!="")
                //si on a fourni un nom d'article on affiche tous les articles ayant ce nom
                $speciality = $propertySearch->getSpeciality();
            if ($speciality!="")
                //si on a fourni un nom d'article on affiche tous les articles ayant ce n
                //om
                $doctors= $this->getDoctrine()->getRepository(Doctor::class)->findBy(['speciality' => $speciality] );
           else
              //si si aucun nom n'est fourni on affiche tous les articles
              $doctors= $this->getDoctrine()->getRepository(Doctor::class)->findAll();
 }
           return $this->render('doctor/indexadmin.html.twig',[ 'form' =>$form->createView(), 'doctors' => $doctors]);
 }


    /**
     * @Route("/new", name="doctor_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $doctor = new Doctor();
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($doctor);
            $entityManager->flush();

            return $this->redirectToRoute('doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('doctor/new.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doctor_show", methods={"GET"})
     */
    public function show(Doctor $doctor): Response
    {
        return $this->render('doctor/show.html.twig', [
            'doctor' => $doctor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="doctor_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Doctor $doctor): Response
    {
        $form = $this->createForm(DoctorType::class, $doctor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('doctor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('doctor/edit.html.twig', [
            'doctor' => $doctor,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/del", name="doctor_delete", methods={"POST"})
     */
    public function delete(Request $request, Doctor $doctor): Response
    {
        if ($this->isCsrfTokenValid('delete'.$doctor->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($doctor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('doctor_index', [], Response::HTTP_SEE_OTHER);
    }
}
