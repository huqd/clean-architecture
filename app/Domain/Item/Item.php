<?php

namespace App\Domain\Item;

class Item
{
    protected $product_price; # USD
    protected $weight; # Kg
    protected $width;   # Meter
    protected $height;
    protected $depth;

    public function __construct($product_price, $weight, $width, $height, $depth)
    {
        $this->product_price = $product_price;
        $this->weight = $weight;
        $this->width = $width;
        $this->height = $height;
        $this->depth = $depth;
    }

    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }
    public function getProductPrice()
    {
        return $this->product_price;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    public function getWeight()
    {
        return $this->weight;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }
    public function getWidth()
    {
        return $this->width;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }
    public function getHeight()
    {
        return $this->height;
    }

    public function setDepth($depth)
    {
        $this->depth = $depth;
    }
    public function getDepth()
    {
        return $this->depth;
    }


}
