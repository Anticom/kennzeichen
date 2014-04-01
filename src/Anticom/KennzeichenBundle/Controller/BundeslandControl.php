<?php
/**
 * Created by PhpStorm.
 * User: Anticom
 * Date: 01.04.14
 * Time: 21:26
 */

namespace Anticom\KennzeichenBundle\Controller;

use Anticom\KennzeichenBundle\Entity\Bundesland;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

    /** @ParamConverter("name", class="AnticomKennzeichenBundle:Bundesland") */
    public function showAction(Bundesland $bundesland)
    {
        return $this->render(
            'AnticomKennzeichenBundle:Bundesland:show.html.twig',
            array(
                'bundesland' => $bundesland
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