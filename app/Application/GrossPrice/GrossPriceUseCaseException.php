<?php

namespace App\Application\GrossPrice;

use Exception;

class GrossPriceUseCaseException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
