<?php

namespace App\Application;

abstract class UseCaseInput
{
    private $id;

    abstract public function validate($input);
}
