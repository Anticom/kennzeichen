<?php

namespace Anticom\KennzeichenBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Kennzeichen
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @Serializer\ExclusionPolicy("none")
 * @Serializer\XmlRoot("kennzeichen")
 */
class Kennzeichen
{
    #region params
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
     *
     * @Serializer\Type("Anticom\KennzeichenBundle\Entity\Bundesland")
     */
    private $bundesland;

    /**
     * @Serializer\Exclude
     */
    protected static $twig;
    #endregion

    #region constants
    const WIKIPEDIA_BASE             = 'http://de.wikipedia.org/wiki/';
    const WIKIPEDIA_URI_TEMPLATE     = '//de.wikipedia.org/wiki/{{query}}';
    const WIKIPEDIA_API_URI_TEMPLATE = 'http://de.wikipedia.org/w/api.php?format=json&action=parse&page={{query}}&prop=text&section=0';
    const MAPS_URI_TEMPLATE          = '';
    #endregion

    #region getters & setters
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
    #endregion

    #region auxiliaries
    protected function renderStringTemplate($template, $context = array())
    {
        if (!self::$twig) {
            self::$twig = new \Twig_Environment(new \Twig_Loader_String());
        }
        return self::$twig->render($template, $context);
    }

    public function getWikiIntro()
    {
        $wikiUri = $this->renderStringTemplate(self::WIKIPEDIA_API_URI_TEMPLATE, array('query' => $this->kreis));
        $json    = file_get_contents($wikiUri);
        $wiki    = json_decode($json, true);

        $html = 'Fehler beim Abrufen des Wikipedia Artikels';
        $crawler = new Crawler(null, self::WIKIPEDIA_BASE);
        if(isset($wiki['parse']['text']['*'])) {
            $crawler->addHtmlContent($wiki['parse']['text']['*']);
            $intro = $crawler->filter('p');

            //rewrite all links
            /*
            $prefix = self::WIKIPEDIA_BASE;
            foreach($intro->links() as $link) {
                $linkNode = $link->getNode();
                $href = $linkNode->getAttribute('href');

                $linkNode->getAttributeNode('href')->value = $prefix . $href;
                //$link->setAttributeNode(new \DOMAttr('rel', 'nofollow'));
                $linkNode->setAttributeNode(new \DOMAttr('target', '_blank'));
            }
            */

            $html  = $intro->html();
        }
        return $html;
    }

    public function getWikiLink()
    {
        return $this->renderStringTemplate(self::WIKIPEDIA_URI_TEMPLATE, array('query' => $this->kreis));
    }
    #endregion
}
