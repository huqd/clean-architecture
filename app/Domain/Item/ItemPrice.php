<?php

namespace App\Domain\Item;

use App\Domain\Item\Item;
use App\Domain\Configuration;


class ItemPrice
{
    private $item;
    private $shipFee;
    private $price;

    public function __construct($item, $shipFee)
    {
        $this->item = $item;
        $this->shipFee = $shipFee;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function price()
    {
        $price = $this->item->getProductPrice() + $this->shipFee->fee();
        $this->price = $price; # Cache price.
        return $price;
    }
}
