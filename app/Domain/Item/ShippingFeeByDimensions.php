<?php


namespace App\Domain\Item;


use App\Domain\Configuration;

class ShippingFeeByDimensions implements ShippingFeeInterface
{
    private $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function fee()
    {
        return max($this->feeByWeight(), $this->feeByDimensions());
    }


    protected function feeByWeight($i)
    {
        return $this->item->getWeight() * Configuration::getInstance()->getWeightCoefficient();
    }

    protected function feeByDimensions()
    {
        return $this->item->getWidth() * $this->item->getHeight() * $this->item->getDepth() * Configuration::getInstance()->getDimensionCoefficient();
    }
}