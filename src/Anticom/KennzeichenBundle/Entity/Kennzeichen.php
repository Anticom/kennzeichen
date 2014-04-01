<?php

namespace Anticom\KennzeichenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kennzeichen
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Kennzeichen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="kuerzel", type="string", length=3)
     */
    private $kuerzel;

    /**
     * @var string
     *
     * @ORM\Column(name="kreis", type="string", length=255)
     */
    private $kreis;
	
	/**
     * @var Bundesland
     *
     * @ORM\ManyToOne(targetEntity="Bundesland", inversedBy="kennzeichen")
     * @ORM\JoinColumn(name="bundesland_id", referencedColumnName="id", onDelete="CASCADE")
     */
	private $bundesland;

    /**
     * Set bundesland
     *
     * @param \Anticom\KennzeichenBundle\Entity\Bundesland $bundesland
     * @return Kennzeichen
     */
    public function setBundesland(\Anticom\KennzeichenBundle\Entity\Bundesland $bundesland = null)
    {
        $this->bundesland = $bundesland;

        return $this;
    }

    /**
     * Get bundesland
     *
     * @return \Anticom\KennzeichenBundle\Entity\Bundesland 
     */
    public function getBundesland()
    {
        return $this->bundesland;
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
     * Set kuerzel
     *
     * @param string $kuerzel
     * @return Kennzeichen
     */
    public function setKuerzel($kuerzel)
    {
        $this->kuerzel = $kuerzel;

        return $this;
    }

    /**
     * Get kuerzel
     *
     * @return string 
     */
    public function getKuerzel()
    {
        return $this->kuerzel;
    }

    /**
     * Set kreis
     *
     * @param string $kreis
     * @return Kennzeichen
     */
    public function setKreis($kreis)
    {
        $this->kreis = $kreis;

        return $this;
    }

    /**
     * Get kreis
     *
     * @return string 
     */
    public function getKreis()
    {
        return $this->kreis;
    }
}
