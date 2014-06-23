<?php

namespace RL\CMSBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use RL\CMSBundle\Entity\Block;
use RL\CMSBundle\Form\BlockType;

/**
 * Block controller.
 *
 * @Route("/block")
 */
class BlockController extends Controller
{

    /**
     * Lists all Block entities.
     *
     * @Route("/", name="admin_block")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('RLCMSBundle:Block')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Block entity.
     *
     * @Route("/", name="admin_block_create")
     * @Method("POST")
     * @Template("RLCMSBundle:Block:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Block();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_block_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Block entity.
    *
    * @param Block $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Block $entity)
    {
        $form = $this->createForm(new BlockType(), $entity, array(
            'action' => $this->generateUrl('admin_block_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Block entity.
     *
     * @Route("/new", name="admin_block_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Block();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Block entity.
     *
     * @Route("/{id}", name="admin_block_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RLCMSBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Block entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Block entity.
     *
     * @Route("/{id}/edit", name="admin_block_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RLCMSBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Block entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Block entity.
    *
    * @param Block $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Block $entity)
    {
        $form = $this->createForm(new BlockType(), $entity, array(
            'action' => $this->generateUrl('admin_block_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Block entity.
     *
     * @Route("/{id}", name="admin_block_update")
     * @Method("PUT")
     * @Template("RLCMSBundle:Block:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('RLCMSBundle:Block')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Block entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_block_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Block entity.
     *
     * @Route("/{id}", name="admin_block_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('RLCMSBundle:Block')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Block entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_block'));
    }

    /**
     * Creates a form to delete a Block entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_block_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
