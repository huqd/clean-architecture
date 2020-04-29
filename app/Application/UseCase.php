<?php

namespace App\Application;

use App\Application\{UseCaseInput, UseCaseOutput};

interface UseCase
{
    public function execute(UseCaseInput $input): UseCaseOutput;
}
