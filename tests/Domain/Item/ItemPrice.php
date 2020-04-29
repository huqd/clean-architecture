<?php

namespace Tests\Domain\Item;

use PHPUnit\Framework\TestCase;
use App\Domain\Item\{Item, ItemPrice};

class ItemPriceTest extends TestCase
{
    public function testItemPrice(){
        $item = new Item(105, 3.5, 0.5, 0.5, 0.1); # $product_price, $weight, $width, $height, $depth
        $item_price = new ItemPrice($item);
        $this->assertEquals(143.5, $item_price->calculatePrice());
    }
}