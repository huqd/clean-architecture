<?php

namespace App\Application\GrossPrice;

use App\Application\{UseCase, UseCaseInput, UseCaseOutput};
use App\Domain\Item\{ItemRepository, Item, ItemPrice, ItemCreateException};
use App\Application\GrossPrice\{GrossPriceUseCaseOutput, GrossPriceUseCaseException};
use Exception;

class GrossPriceUseCase implements UseCase
{
    private $repo;

    public function __construct(ItemRepository $repo)
    {
        $this->repo = $repo;
    }

    public function execute(UseCaseInput $input): UseCaseOutput
    {
        try {
            $gross_price = 0;

            foreach ($input->items_urls as $url) {
                $item = $this->repo->getById($url); # Fetch item from repository
                $item_price = (new ItemPrice($item))->calculatePrice();
                $gross_price += $item_price;
            }

            return new GrossPriceUseCaseOutput($gross_price);

        } catch (ItemCreateException $e) {
            throw new GrossPriceUseCaseException("Could not calculate price of item(s). Please check if the price, weight and dimensions of product are available");
        } catch (Exception $s) { # Other exceptions
            throw new GrossPriceUseCaseException("Something went wrong");
        }
    }
}
