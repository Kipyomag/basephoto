<?php

namespace GalerieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GalerieBundle\Entity\Galery;
use GalerieBundle\Form\GaleryType;

/**
 * Galery controller.
 *
 * @Route("/galery")
 */
class GaleryController extends Controller
{
    /**
     * Lists all Galery entities.
     *
     * @Route("/", name="galery_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $galeries = $em->getRepository('GalerieBundle:Galery')->findAll();

        return $this->render('galery/index.html.twig', array(
            'galeries' => $galeries,
        ));
    }

    /**
     * Creates a new Galery entity.
     *
     * @Route("/new", name="galery_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $galery = new Galery();
        $form = $this->createForm(new GaleryType(), $galery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($galery);
            $em->flush();

            return $this->redirectToRoute('galery_show', array('id' => $galery->getId()));
        }

        return $this->render('galery/new.html.twig', array(
            'galery' => $galery,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Galery entity.
     *
     * @Route("/{id}", name="galery_show")
     * @Method("GET")
     */
    public function showAction(Galery $galery)
    {
        $deleteForm = $this->createDeleteForm($galery);

        return $this->render('galery/show.html.twig', array(
            'galery' => $galery,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Galery entity.
     *
     * @Route("/{id}/edit", name="galery_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Galery $galery)
    {
        $deleteForm = $this->createDeleteForm($galery);
        $editForm = $this->createForm(new GaleryType(), $galery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($galery);
            $em->flush();

            return $this->redirectToRoute('galery_edit', array('id' => $galery->getId()));
        }

        return $this->render('galery/edit.html.twig', array(
            'galery' => $galery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Galery entity.
     *
     * @Route("/{id}", name="galery_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Galery $galery)
    {
        $form = $this->createDeleteForm($galery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($galery);
            $em->flush();
        }

        return $this->redirectToRoute('galery_index');
    }

    /**
     * Creates a form to delete a Galery entity.
     *
     * @param Galery $galery The Galery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Galery $galery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('galery_delete', array('id' => $galery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
