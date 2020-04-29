<?php

namespace App\Domain\Item;

use App\Domain\Item\Item;

interface ItemRepository
{
    public function getById($id) : Item;
}
