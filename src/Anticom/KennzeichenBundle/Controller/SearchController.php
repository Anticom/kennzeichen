<?php
/**
 * Created by PhpStorm.
 * User: muehlbti
 * Date: 07.04.14
 * Time: 09:24
 */

namespace Anticom\KennzeichenBundle\Controller;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    public function searchAction(Request $request)
    {
        $search = $request->query->get('query');
        $kennzeichen = $this->doSearch($search);

        return $this->render(
            'AnticomKennzeichenBundle:Search:search.html.twig',
            array(
                'kennzeichen' => $kennzeichen
            )
        );
    }

    public function ajaxSearchAction(Request $request)
    {
        $search = $request->query->get('query');
        $kennzeichen = $this->doSearch($search);

        //serialize:
        $serializer = $this->get('jms_serializer');
        $data       = $serializer->serialize($kennzeichen, 'json');

        return new Response($data);
    }

    protected function doSearch($searchTerm = null)
    {
        $kennzeichen = array();
        if ($searchTerm !== null) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();

            $searchTerm = '%' . $searchTerm . '%';
            $dql        = 'SELECT k FROM AnticomKennzeichenBundle:Kennzeichen k JOIN k.bundesland b WHERE k.id LIKE :query OR k.kuerzel LIKE :query OR k.kreis LIKE :query OR b.name LIKE :query';
            $searchTerm = $em->createQuery($dql)
                ->setParameter('query', $searchTerm);

            $kennzeichen = $searchTerm->getResult();
        }

        return $kennzeichen;
    }
} 