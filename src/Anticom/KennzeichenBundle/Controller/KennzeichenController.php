<?php
/**
 * Created by PhpStorm.
 * User: Anticom
 * Date: 01.04.14
 * Time: 21:21
 */

namespace Anticom\KennzeichenBundle\Controller;

use Anticom\KennzeichenBundle\Entity\Kennzeichen;
use Anticom\KennzeichenBundle\Entity\KennzeichenList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    public function editAction(Kennzeichen $kennzeichen)
    {
        //TODO add form

        return $this->render(
            'AnticomKennzeichenBundle:Kennzeichen:edit.html.twig',
            array(
                'kennzeichen' => $kennzeichen
            )
        );
    }

    /** @ParamConverter("kennzeichen", class="AnticomKennzeichenBundle:Kennzeichen") */
    public function deleteAction(Kennzeichen $kennzeichen)
    {
        //TODO add form

        return $this->render(
            'AnticomKennzeichenBundle:Kennzeichen:delete.html.twig',
            array(
                'kennzeichen' => $kennzeichen
            )
        );
    }

    public function exportAction($_format) {
        $kennzeichen = $this->getKennzeichenRepo()->findAll();
        $kennzeichen = array_slice($kennzeichen, 0, 2);
        $data = new KennzeichenList($kennzeichen);

        $serializer = $this->get('jms_serializer');
        $serialized = $serializer->serialize($data, $_format);
        return new Response($serialized);
    }

    public function importAction() {
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
