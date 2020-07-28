<?php

namespace App\Controller;

use App\Entity\Victime;
use App\Form\VictimeType;
use App\Repository\VictimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/victime")
 */
class VictimeController extends AbstractController
{
    /**
     * @Route("/", name="victime_index", methods={"GET"})
     */
    public function index(VictimeRepository $victimeRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'victimes' => $victimeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="victime_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $victime = new Victime();
        $form = $this->createForm(VictimeType::class, $victime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photoFile = $form->get('photo')->getData();
            $photoFilename = uniqid().'.'.$photoFile->guessExtension();
            try{
                $photoFile->move(
                    $this->getParameter('images_victimes_directory'),
                    $photoFilename
                );
            }catch (FileException $e){

            }
            $victime->setPhoto($photoFilename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($victime);
            $entityManager->flush();

            return $this->redirectToRoute('victime_index');
        }

        return $this->render('front/victime/new.html.twig', [
            'victime' => $victime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="victime_show", methods={"GET"})
     */
    public function show(Victime $victime, VictimeRepository $victimeRepository): Response
    {
        return $this->render('front/victime/show.html.twig', [
            'victime' => $victime,
            'victimes' => $victimeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="victime_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Victime $victime): Response
    {
        $form = $this->createForm(VictimeType::class, $victime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('victime_index');
        }

        return $this->render('victime/edit.html.twig', [
            'victime' => $victime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="victime_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Victime $victime): Response
    {
        if ($this->isCsrfTokenValid('delete'.$victime->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($victime);
            $entityManager->flush();
        }

        return $this->redirectToRoute('victime_index');
    }
}
