<?php
/**
 * Created by PhpStorm.
 * User: Anticom
 * Date: 01.04.14
 * Time: 21:21
 */

namespace Anticom\KennzeichenBundle\Controller;

use Anticom\KennzeichenBundle\Entity\Kennzeichen;
use Anticom\KennzeichenBundle\Form\KennzeichenType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class KennzeichenController extends Controller
{
    public function listAction($page)
    {
        //TODO add pagination
        /** @var Kennzeichen[] $kennzeichen */
        $repo        = $this->getKennzeichenRepo();
        $kennzeichen = $repo->findAll();

        return $this->render(
            'AnticomKennzeichenBundle:Kennzeichen:list.html.twig',
            array(
                'kennzeichen' => $kennzeichen
            )
        );
    }

    /** @ParamConverter("kennzeichen", class="AnticomKennzeichenBundle:Kennzeichen") */
    public function showAction(Kennzeichen $kennzeichen)
    {
        return $this->render(
            'AnticomKennzeichenBundle:Kennzeichen:show.html.twig',
            array(
                'kennzeichen' => $kennzeichen,
                'wiki'        => $kennzeichen->getWikiIntro()
            )
        );
    }

    /** @ParamConverter("kennzeichen", class="AnticomKennzeichenBundle:Kennzeichen") */
    public function editAction(Request $request, Kennzeichen $kennzeichen)
    {
        $form = $this->createForm(new KennzeichenType(), $kennzeichen);

        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $em->persist($kennzeichen);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Die Änderungen wurden erfolgreich Gespeichert!');
            return $this->redirect($this->generateUrl('anticom_kennzeichen_list'));
        }

        return $this->render(
            'AnticomKennzeichenBundle:Kennzeichen:edit.html.twig',
            array(
                'kennzeichen' => $kennzeichen,
                'form'        => $form->createView()
            )
        );
    }

    /** @ParamConverter("kennzeichen", class="AnticomKennzeichenBundle:Kennzeichen") */
    public function deleteAction(Request $request, Kennzeichen $kennzeichen)
    {
        $form = $this->createFormBuilder($kennzeichen)
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
        if($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $em->persist($kennzeichen);
            $em->remove($kennzeichen);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Das Kennzeichen wurde erfoglreich gelöscht!');
            return $this->redirect($this->generateUrl('anticom_kennzeichen_list'));
        }

        return $this->render(
            'AnticomKennzeichenBundle:Kennzeichen:delete.html.twig',
            array(
                'kennzeichen' => $kennzeichen,
                'form'        => $form->createView()
            )
        );
    }

    public function exportAction($_format)
    {
        $kennzeichen = $this->getKennzeichenRepo()->findAll();
        //$data        = new KennzeichenList($kennzeichen);

        $serializer = $this->get('jms_serializer');
        $serialized = $serializer->serialize($kennzeichen, $_format);

        return new Response($serialized);
    }

    public function importAction()
    {
        //TODO add form

        return $this->render('AnticomKennzeichenBundle:Kennzeichen:import.html.twig');
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getKennzeichenRepo()
    {
        /** @var \Doctrine\ORM\EntityManager $em */
        $em   = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('AnticomKennzeichenBundle:Kennzeichen');

        return $repo;
    }
}
