<?php
/**
 * Created by PhpStorm.
 * User: Anticom
 * Date: 01.04.14
 * Time: 21:21
 */

namespace Anticom\KennzeichenBundle\Controller;

use Anticom\KennzeichenBundle\Entity\Kennzeichen;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class KennzeichenController extends Controller
{
    public function listAction($page = 1)
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
                'kennzeichen' => $kennzeichen
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