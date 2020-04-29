<?php

namespace App\Application\GrossPrice;

use App\Application\GrossPrice\GrossPriceUseCaseOutput;

class GrossPricePresenterCLI
{
    private $content;

    public function __construct(GrossPriceUseCaseOutput $content)
    {
        $this->content = $content;
    }

    public function present()
    {
        # Manipulate the content to generate view model
        $view_model = (string) $this->content->price;
        return $view_model;
    }
}
