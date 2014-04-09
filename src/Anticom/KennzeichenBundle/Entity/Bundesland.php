<?php

namespace Anticom\KennzeichenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Bundesland
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @Serializer\ExclusionPolicy("none")
 * @Serializer\XmlRoot("bundesland")
 */
class Bundesland
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\XmlAttribute
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var Kennzeichen[]
     * @ORM\OneToMany(targetEntity="Kennzeichen", mappedBy="bundesland")
     *
     * @Serializer\Exclude
     */
	private $kennzeichen;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->kennzeichen = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add kennzeichen
     *
     * @param \Anticom\KennzeichenBundle\Entity\Kennzeichen $kennzeichen
     * @return Bundesland
     */
    public function addKennzeichen(\Anticom\KennzeichenBundle\Entity\Kennzeichen $kennzeichen)
    {
        $this->kennzeichen[] = $kennzeichen;

        return $this;
    }

    /**
     * Remove kennzeichen
     *
     * @param \Anticom\KennzeichenBundle\Entity\Kennzeichen $kennzeichen
     */
    public function removeKennzeichen(\Anticom\KennzeichenBundle\Entity\Kennzeichen $kennzeichen)
    {
        $this->kennzeichen->removeElement($kennzeichen);
    }

    /**
     * Get kennzeichen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKennzeichen()
    {
        return $this->kennzeichen;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Bundesland
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
