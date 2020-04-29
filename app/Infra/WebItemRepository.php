<?php

namespace App\Infra;

use App\Domain\Item\{Item, ItemRepository, ItemCreateException};
use App\Domain\Configuration;
use Exception;


class WebItemRepository implements ItemRepository
{
    const INCHE_TO_METER = 0.0254;
    const POUND_TO_KG = 0.453592;
    const OUNCE_TO_KG = 0.0283495;
    const OUNCES = "ounces";
    const POUNDS = "pounds";

    public function getById($url): Item
    {
        try {
            $string = file_get_contents($url);

            // Get dimensions
            // Length (depth) x Width x Height
            $pattern = '/Product\sDimensions[\s:]*<\/[a-z]*>\s*<[a-z]*\s*[="\sa-z-A-Z]*>\s*([.0-9]*)\sx\s([.0-9]*)\sx\s([.0-9]*)\sinches\s*<\/[a-z]*>/';

            $success = preg_match($pattern, $string, $match);
            if ($success) {
                $depth = $match[1] * self::INCHE_TO_METER;
                $width = $match[2] * self::INCHE_TO_METER;
                $height = $match[3] * self::INCHE_TO_METER;
            }

            # Get weight
            $pattern = '/Weight[\s:]*<\/[a-z]*>\s*<[a-z]*\s*[="\sa-z-A-Z]*>\s*([.0-9]*)\s(ounces|pounds)/';
            $success = preg_match($pattern, $string, $match);
            if ($success) {
                $unit = $match[2];
                if ($unit == self::POUNDS) {
                    $weight = $match[1] * self::POUND_TO_KG;
                } elseif ($unit == self::OUNCES) {
                    $weight = $match[1] * self::OUNCE_TO_KG;
                }
            }

            # Get price
            $pattern = '/<span id="priceblock_ourprice"\s*[="\sa-z-A-Z]*>\$([.0-9]*)/';
            $success = preg_match($pattern, $string, $match);
            if ($success) {
                $price = $match[1];
            }

            # Verify all
            if (!isset($price, $weight, $width, $height, $depth)) {
                // Logging
                throw new Exception("Error parsing item properties");
            }
            return new Item($price, $weight, $width, $height, $depth);
        } catch (Exception $e) {
            // Handle exceptions, logging
            // Throw a domain-specified exception for the domain layer to know
            throw new ItemCreateException("Could not load item");
        }
    }
}
