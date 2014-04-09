<?php
/**
 * Created by PhpStorm.
 * User: Anticom
 * Date: 09.04.14
 * Time: 14:53
 */

namespace Anticom\KennzeichenBundle\Entity;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class KennzeichenList
 *
 * @Serializer\ExclusionPolicy("none")
 * @Serializer\XmlRoot("kennzeichen_list")
 */
class KennzeichenList
{
    /**
     * @var Kennzeichen[]
     *
     * @Serializer\SerializedName("kennzeichen")
     */
    protected $kennzeichen;

    public function __construct(array $kennzeichen = array()) {
        $this->kennzeichen = $kennzeichen;
    }

    /**
     * @param Kennzeichen[] $kennzeichen
     * @return $this
     */
    public function setKennzeichen($kennzeichen)
    {
        $this->kennzeichen = $kennzeichen;

        return $this;
    }

    /**
     * @return Kennzeichen[]
     */
    public function getKennzeichen()
    {
        return $this->kennzeichen;
    }
} 
