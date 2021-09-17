<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Merchant;

class ProductUnitTest extends TestCase
{
    /** @test */
    public function product_belongs_to_merchant()
    {
        $product = Product::factory()->create();
        $this->assertInstanceOf(Merchant::class, $product->merchant);
    }
}
