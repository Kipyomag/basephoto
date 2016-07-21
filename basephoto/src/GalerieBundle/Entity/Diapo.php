<?php

namespace GalerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diapo
 *
 * @ORM\Table(name="diapo")
 * @ORM\Entity(repositoryClass="GalerieBundle\Repository\DiapoRepository")
 */
class Diapo
{
    /**
     * @ORM\ManyToOne(targetEntity="Galery", inversedBy="diapos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $galery;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=30)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="online", type="boolean")
     */
    private $online;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Diapo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Diapo
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set online
     *
     * @param boolean $online
     *
     * @return Diapo
     */
    public function setOnline($online)
    {
        $this->online = $online;

        return $this;
    }

    /**
     * Get online
     *
     * @return bool
     */
    public function getOnline()
    {
        return $this->online;
    }

    /**
     * Set galery
     *
     * @param \GalerieBundle\Entity\Galery $galery
     *
     * @return Diapo
     */
    public function setGalery(\GalerieBundle\Entity\Galery $galery = null)
    {
        $this->galery = $galery;
        $galery->addDiapo($this);

        return $this;
    }

    /**
     * Get galery
     *
     * @return \GalerieBundle\Entity\Galery
     */
    public function getGalery()
    {
        return $this->galery;
    }
}
