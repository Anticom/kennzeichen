<?php
/**
 * Created by PhpStorm.
 * User: Anticom
 * Date: 01.04.14
 * Time: 22:29
 */

namespace Anticom\KennzeichenBundle\DataFixtures\ORM;

use Anticom\KennzeichenBundle\Entity\Bundesland;
use Anticom\KennzeichenBundle\Entity\Kennzeichen;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDummyKennzeichen extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    protected $manager;

    protected static $kreise;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        //config
        $ammount = 50;

        //loading
        $this->manager = $manager;
        $this->loadKreise();

        $kreis = $this->getRandomKreis();

        for($i = 0; $i < $ammount; $i++) {
            $kennzeichen = new Kennzeichen();
            $kennzeichen
                ->setBundesland($this->getRandomBundesland())
                ->setKreis($kreis)
                ->setKuerzel(substr($kreis, 0, rand(1, 2)));

            $manager->persist($kennzeichen);
        }


        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }

    /**
     * @return Bundesland
     */
    protected function getRandomBundesland()
    {
        $bundeslaender = array(
            'Baden-Württemberg',
            'Bayern',
            'Berlin',
            'Brandenburg',
            'Bremen',
            'Hamburg',
            'Hessen',
            'Mecklenburg-Vorpommern',
            'Niedersachsen',
            'Nordrhein-Westfalen',
            'Rheinland-Pfalz',
            'Saarland',
            'Sachsen',
            'Sachsen-Anhalt',
            'Schleswig-Holstein',
            'Thüringen',
        );
        $max           = count($bundeslaender) - 1;
        $chosen        = $bundeslaender[rand(0, $max)];

        return $this->manager->getRepository('AnticomKennzeichenBundle:Bundesland')->findOneBy(array('name' => $chosen));
    }

    protected function loadKreise()
    {
        static::$kreise = array_map(
            function ($e) {
                preg_match('/^[a-zA-Z]+/', $e[1], $result);
                return $result[0];
            },
            json_decode(
                file_get_contents('landkreise.json'),
                true
            )
        );
    }

    protected function getRandomKreis()
    {
        $max = count(static::$kreise) - 1;
        return static::$kreise[rand(0, $max)];
    }
} 