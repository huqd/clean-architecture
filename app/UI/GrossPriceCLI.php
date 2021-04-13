<?php

namespace App\UI;

use App\Application\GrossPrice\{GrossPriceUseCase, GrossPriceUseCaseInput, GrossPriceUseCaseOutput, GrossPricePresenterCLI};
use App\Infrastructure\WebItemRepository;
use Exception;

class GrossPriceCLI
{
    public function calculate($foptions)
    {
        try {
            echo "Calculating...";
            # View input
            $urls = $this->normalizeInput($foptions);
            $usecaseInput = new GrossPriceUseCaseInput($urls);

            # Execute use case
            $repo = new WebItemRepository(); # Should be injected by a IoC container
            $usecase = new GrossPriceUseCase($repo);
            $output = $usecase->execute($usecaseInput);

            # View output
            $presenter = new GrossPricePresenterCLI($output);
            $grossPrice = $presenter->present();
            echo "\n\nGross price: \$$grossPrice";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    private function normalizeInput($foptions)
    {
        if (is_string($foptions)) {
            return array($foptions);
        }
        return $foptions;
    }
}
