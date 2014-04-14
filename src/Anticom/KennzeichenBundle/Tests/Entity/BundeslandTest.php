<?php
/**
 * User: Timo Mühlbach
 * Date: 14.04.14
 * Time: 15:12
 */

namespace Anticom\KennzeichenBundle\Tests\Entity;


use Anticom\KennzeichenBundle\Entity\Bundesland;
use Anticom\KennzeichenBundle\Entity\Kennzeichen;
use PHPUnit_Framework_TestCase;

class BundeslandTest extends PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $bundesland = new Bundesland();
        $this->assertEquals('name', $bundesland->setName('name')->getName());
    }

    public function testKennzeichen()
    {
        $kennzeichen = new Kennzeichen();

        $bundesland = new Bundesland();
        $bundesland->addKennzeichen($kennzeichen);
        $this->assertTrue($bundesland->getKennzeichen()->contains($kennzeichen));
    }

    public function testKennzeichenEmpty()
    {
        $bundesland = new Bundesland();
        $this->assertTrue($bundesland->getKennzeichen()->isEmpty());
    }
}
 