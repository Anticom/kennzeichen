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
use Symfony\Component\Filesystem\Exception\IOException;

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
        //loading
        $this->manager = $manager;
        $this->loadKreise();

        foreach(static::$kreise as $kreis) {
            $kennzeichen = new Kennzeichen();
            $kennzeichen
                ->setBundesland($this->getBundeslandByName($kreis['bundesland']))
                ->setKreis($kreis['kreis'])
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
     * @param $name
     * @return Bundesland
     */
    protected function getBundeslandByName($name)
    {
        return $this->manager->getRepository('AnticomKennzeichenBundle:Bundesland')->findOneBy(array('name' => $name));
    }

    protected function loadKreise()
    {
        $filename = __DIR__ . DIRECTORY_SEPARATOR . 'landkreise.json';
        if (!file_exists($filename)) {
            throw new IOException();
        }

        static::$kreise = array();

        $landkreise = json_decode(file_get_contents($filename), true);
        foreach ($landkreise as $landkreis) {
            static::$kreise[] = array(
                'kreis'         => $landkreis[3],
                'bundesland'    => $landkreis[2]
            );
        }
    }
} 