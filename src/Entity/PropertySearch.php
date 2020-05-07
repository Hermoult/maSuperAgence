<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


class PropertySearch {

    private $maxPrice;
        
    /**
     * minSurface
     * @Assert\Range(min=10, max=400)
     * @var int | null
     */
    private $minSurface;
    
    /**
     * option
     *
     * @var ArrayCollection
     */
    private $option;

    public function __construct()
    {
        $this->option = new ArrayCollection();
    }

    /**
     * Get the value of maxPrice
     */ 
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * Set the value of maxPrice
     *
     * @return  self
     */ 
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get the value of minSurface
     */ 
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * Set the value of minSurface
     *
     * @return  self
     */ 
    public function setMinSurface($minSurface)
    {
        $this->minSurface = $minSurface;

        return $this;
    }

    /**
     * Get option
     *
     * @return  ArrayCollection
     */ 
    public function getOption() : ArrayCollection
    {
        return $this->option;
    }

    /**
     * @param  ArrayCollection  $option
     * @return  self
     */ 
    public function setOption(ArrayCollection $option) 
    {
        $this->option = $option;

        return $this;
    }
}