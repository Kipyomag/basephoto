<?php

namespace GalerieBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GalerieBundle\Entity\Diapo;
use GalerieBundle\Form\DiapoType;

/**
 * Diapo controller.
 *
 * @Route("/diapo")
 */
class DiapoController extends Controller
{
    /**
     * Lists all Diapo entities.
     *
     * @Route("/", name="diapo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $diapos = $em->getRepository('GalerieBundle:Diapo')->findAll();

        return $this->render('diapo/index.html.twig', array(
            'diapos' => $diapos,
        ));
    }

    /**
     * Creates a new Diapo entity.
     *
     * @Route("/new", name="diapo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $diapo = new Diapo();
        $form = $this->createForm(new DiapoType(), $diapo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($diapo);
            $em->flush();

            return $this->redirectToRoute('diapo_show', array('id' => $diapo->getId()));
        }

        return $this->render('diapo/new.html.twig', array(
            'diapo' => $diapo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Diapo entity.
     *
     * @Route("/{id}", name="diapo_show")
     * @Method("GET")
     */
    public function showAction(Diapo $diapo)
    {
        $deleteForm = $this->createDeleteForm($diapo);

        return $this->render('diapo/show.html.twig', array(
            'diapo' => $diapo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Diapo entity.
     *
     * @Route("/{id}/edit", name="diapo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Diapo $diapo)
    {
        $deleteForm = $this->createDeleteForm($diapo);
        $editForm = $this->createForm(new DiapoType(), $diapo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($diapo);
            $em->flush();

            return $this->redirectToRoute('diapo_edit', array('id' => $diapo->getId()));
        }

        return $this->render('diapo/edit.html.twig', array(
            'diapo' => $diapo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Diapo entity.
     *
     * @Route("/{id}", name="diapo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Diapo $diapo)
    {
        $form = $this->createDeleteForm($diapo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($diapo);
            $em->flush();
        }

        return $this->redirectToRoute('diapo_index');
    }

    /**
     * Creates a form to delete a Diapo entity.
     *
     * @param Diapo $diapo The Diapo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Diapo $diapo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('diapo_delete', array('id' => $diapo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
