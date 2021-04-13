<?php

namespace App\Application\GrossPrice;

use App\Application\{UseCase, UseCaseInput, UseCaseOutput};
use App\Domain\Item\{ItemRepository, Item, ItemPrice, ItemCreateException, ShippingFeeByDimensions};
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
            $grossPrice = 0;

            foreach ($input->getItemsUrls() as $url) {
                $item = $this->repo->getById($url); # Fetch item from repository

                $shippingFee = new ShippingFeeByDimensions($item);
                $itemPrice = new ItemPrice($item, $shippingFee);
                $price = $itemPrice->price();
                $grossPrice += $price;
            }

            return new GrossPriceUseCaseOutput($grossPrice);

        } catch (ItemCreateException $e) {
            throw new GrossPriceUseCaseException("Could not calculate price of item(s). Please check if the price, weight and dimensions of product are available");
        } catch (Exception $s) { # Other exceptions
            throw new GrossPriceUseCaseException("Something went wrong");
        }
    }
}
