<?php

namespace App\Application\GrossPrice;

use App\Application\UseCaseOutput;

class GrossPriceUseCaseOutput extends UseCaseOutput
{
    public $price;
    public function __construct($price)
    {
        $this->price = $price;
    }
}
