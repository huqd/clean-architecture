<?php

namespace App\Application\GrossPrice;

use App\Application\UseCaseInput;

class GrossPriceUseCaseInput extends UseCaseInput
{
    private $items_urls;

    public function __construct($items_urls)
    {
        $this->validate($items_urls);
        $this->items_urls = $items_urls;
    }

    public function validate($items_urls)
    {
        return true;
    }

    public function getItemsUrls() {
        return $this->items_urls;
    }
}
