<?php
/**
 *  Copyright (c) 2018
 *
 * This file is part of Webnet Api.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Catgeory",mappedBy="produit")
     *
     * @var ArrayCollection Category
     */
    private $association;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->association = new \Doctrine\Common\Collections\ArrayCollection();
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
     *
     * @return Produit
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

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return Produit
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return integer
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Add association
     *
     * @param \AppBundle\Entity\Catgeory $association
     *
     * @return Produit
     */
    public function addAssociation(\AppBundle\Entity\Catgeory $association)
    {
        $this->association[] = $association;

        return $this;
    }

    /**
     * Remove association
     *
     * @param \AppBundle\Entity\Catgeory $association
     */
    public function removeAssociation(\AppBundle\Entity\Catgeory $association)
    {
        $this->association->removeElement($association);
    }

    /**
     * Get association
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssociation()
    {
        return $this->association;
    }
}
