<?php

namespace App\UI;

use App\Application\GrossPrice\{GrossPriceUseCase, GrossPriceUseCaseInput, GrossPriceUseCaseOutput, GrossPricePresenterCLI};
use App\Infra\WebItemRepository;
use Exception;

class GrossPriceCLI
{
    public function calculate($foptions)
    {
        try {
            echo "Calculating...";
            # View input
            $items_urls = $this->normalizeInput($foptions);
            $usecase_input = new GrossPriceUseCaseInput($items_urls);

            # Execute use case
            $repo = new WebItemRepository(); # Should be injected by a IoC container
            $use_case = new GrossPriceUseCase($repo);
            $output = $use_case->execute($usecase_input);

            $presenter = new GrossPricePresenterCLI($output);

            # View output
            $gross_price = $presenter->present();
            echo "\n\nGross price: \$$gross_price";
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
