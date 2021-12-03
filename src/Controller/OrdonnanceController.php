<?php

namespace App\Controller;

use App\Entity\Ordonnance;
use App\Form\OrdonnanceType;
use App\Repository\OrdonnanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * @Route("/ordonnance")
 */
class OrdonnanceController extends AbstractController
{
    /**
     * @Route("/", name="ordonnance_index", methods={"GET"})
     */
    public function index(OrdonnanceRepository $ordonnanceRepository): Response
    {
        return $this->render('ordonnance/index.html.twig', [
            'ordonnances' => $ordonnanceRepository->findAll(),
        ]);
    }


    /**
     * @Route("/listo", name="ordonnance_list", methods={"GET"})
     */
    public function listo(OrdonnanceRepository $ordonnanceRepository): Response
    {

        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);


        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('ordonnance/listo.html.twig', [
            'ordonnances' => $ordonnanceRepository->findAll(),
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);




    }

    /**
     * @Route("/new", name="ordonnance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ordonnance = new Ordonnance();
        $form = $this->createForm(OrdonnanceType::class, $ordonnance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ordonnance);
            $entityManager->flush();

            return $this->redirectToRoute('ordonnance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordonnance/new.html.twig', [
            'ordonnance' => $ordonnance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ordonnance_show", methods={"GET"})
     */
    public function show(Ordonnance $ordonnance): Response
    {
        return $this->render('ordonnance/show.html.twig', [
            'ordonnance' => $ordonnance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ordonnance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ordonnance $ordonnance): Response
    {
        $form = $this->createForm(OrdonnanceType::class, $ordonnance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ordonnance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ordonnance/edit.html.twig', [
            'ordonnance' => $ordonnance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ordonnance_delete", methods={"POST"})
     */
    public function delete(Request $request, Ordonnance $ordonnance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ordonnance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ordonnance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ordonnance_index', [], Response::HTTP_SEE_OTHER);
    }
}
