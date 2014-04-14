<?php
/**
 * User: Timo Mühlbach
 * Date: 14.04.14
 * Time: 15:22
 */

namespace Anticom\KennzeichenBundle\Tests\Entity;


use Anticom\KennzeichenBundle\Entity\Bundesland;
use Anticom\KennzeichenBundle\Entity\Kennzeichen;
use PHPUnit_Framework_TestCase;

class KennzeichenTest extends PHPUnit_Framework_TestCase
{
    public function testKuerzel()
    {
        $kennzeichen = new Kennzeichen();
        $this->assertEquals('name', $kennzeichen->setKuerzel('name')->getKuerzel());
    }

    public function testKreis()
    {
        $kennzeichen = new Kennzeichen();
        $this->assertEquals('name', $kennzeichen->setKreis('name')->getKreis());
    }

    public function testBundesland()
    {
        $bundesland = new Bundesland();

        $kennzeichen = new Kennzeichen();
        $this->assertEquals($bundesland, $kennzeichen->setBundesland($bundesland)->getBundesland());
    }
}
 