<?php

namespace App\Application;

abstract class UseCaseInput
{
    abstract public function validate($input);
}
