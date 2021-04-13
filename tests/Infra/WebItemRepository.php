<?php

namespace Tests\Infra;

use PHPUnit\Framework\TestCase;
use App\Infrastructure\WebItemRepository;
use App\Domain\Item\Item;


class WebItemRepositoryTest extends TestCase
{
    public function testGetItem(){
        $url = "https://www.amazon.com/Microsoft-PD9-00003-Surface-Dock/dp/B0163HP38W/ref=zg_bs_pc_66?_encoding=UTF8&psc=1&refRID=ZXW8BXDM1QPS47QFDNC0";
        $repo = new WebItemRepository();
        $item = $repo->getById($url);
        $this->assertEquals(144.98, $item->getProductPrice());
        // $this->assertEquals(0.54884632, $item->getWeight());
        // $this->assertEquals(0.12954, $item->getDepth());
        // $this->assertEquals(0.03048, $item->getWidth());
        // $this->assertEquals(0.06096, $item->getHeight());

    }
}