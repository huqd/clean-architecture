<?php

namespace App\Domain\Item;

use Exception;

class ItemCreateException extends Exception
{   
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
