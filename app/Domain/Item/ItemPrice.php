<?php

namespace App\Domain\Item;

use App\Domain\Item\Item;
use App\Domain\Configuration;


class ItemPrice
{
    private $item;
    private $price;

    private static $config;  # Static
    private static $weight_coefficient;
    private static $dimension_coefficient;

    public function __construct($item)
    {
        $this->item = $item;
        self::$config = Configuration::getInstance();
        self::$weight_coefficient = self::$config->getWeightCoefficient();
        self::$dimension_coefficient = self::$config->getDimensionCoefficient();
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function calculatePrice()
    {
        $price = $this->item->getProductPrice() + $this->shipping_fee();
        $this->price = $price; # Save price for later access. No need to recalculate.
        return $price;
    }

    protected function shipping_fee()
    {
        return max($this->fee_by_weight(), $this->fee_by_dimensions());
    }

    protected function fee_by_weight()
    {
        return $this->item->getWeight() * self::$weight_coefficient;
    }

    protected function fee_by_dimensions()
    {
        return $this->item->getWidth() * $this->item->getHeight() * $this->item->getDepth() * self::$dimension_coefficient;
    }
}
