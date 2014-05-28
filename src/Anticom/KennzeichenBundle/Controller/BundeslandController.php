<?php
/**
 * Created by PhpStorm.
 * User: Anticom
 * Date: 01.04.14
 * Time: 21:26
 */

namespace Anticom\KennzeichenBundle\Controller;

use Anticom\KennzeichenBundle\Entity\Bundesland;
use Anticom\KennzeichenBundle\Form\BundeslandType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BundeslandController extends Controller
{
    public function listAction()
    {
        /** @var Bundesland[] $bundeslaender */
        $repo          = $this->getBundeslandRepo();
        $bundeslaender = $repo->findAll();

        return $this->render(
            'AnticomKennzeichenBundle:Bundesland:list.html.twig',
            array(
                'bundeslaender' => $bundeslaender
            )
        );
    }

    public function showAction(Bundesland $bundesland)
    {
        return $this->render(
            'AnticomKennzeichenBundle:Bundesland:show.html.twig',
            array(
                'bundesland' => $bundesland
            )
        );
    }

    public function editAction(Request $request, Bundesland $bundesland)
    {
        $form = $this->createForm(new BundeslandType(), $bundesland);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $em->persist($bundesland);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Die Änderungen wurden erfolgreich Gespeichert!');

            return $this->redirect($this->generateUrl('anticom_kennzeichen_bundesland_list'));
        }

        return $this->render(
            'AnticomKennzeichenBundle:Bundesland:edit.html.twig',
            array(
                'bundesland' => $bundesland,
                'form'       => $form->createView()
            )
        );
    }

    public function deleteAction(Request $request, Bundesland $bundesland)
    {
        $form = $this->createFormBuilder($bundesland)
            ->add(
                'submit',
                'submit',
                array(
                    'label' => 'Bestätigen',
                    'attr'  => array(
                        'class' => 'btn btn-primary'
                    )
                )
            )
            ->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $em->persist($bundesland);
            $em->remove($bundesland);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Das Bundesland wurde erfoglreich gelöscht!');

            return $this->redirect($this->generateUrl('anticom_kennzeichen_bundesland_list'));
        }

        return $this->render(
            'AnticomKennzeichenBundle:Bundesland:delete.html.twig',
            array(
                'bundesland' => $bundesland,
                'form'       => $form->createView()
            )
        );
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getBundeslandRepo()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em   = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AnticomKennzeichenBundle:Bundesland');

        return $repo;
    }
} 