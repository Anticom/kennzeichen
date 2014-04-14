<?php
/**
 * Created by PhpStorm.
 * User: muehlbti
 * Date: 07.04.14
 * Time: 09:24
 */

namespace Anticom\KennzeichenBundle\Controller;


use Symfony\Component\HttpFoundation\Response;

class SearchController
{
    public function searchAction()
    {

    }

    public function ajaxSearchAction()
    {
        $data =array(
            "ActionScript",
            "AppleScript",
            "Asp",
            "BASIC",
            "C",
            "C++",
            "Clojure",
            "COBOL",
            "ColdFusion",
            "Erlang",
            "Fortran",
            "Groovy",
            "Haskell",
            "Java",
            "JavaScript",
            "Lisp",
            "Perl",
            "PHP",
            "Python",
            "Ruby",
            "Scala",
            "Scheme"
        );

        return new Response(json_encode($data), 200, array('content-type' => 'text/json'));
    }
} 