<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Merchant;

class MerchantUnitTest extends TestCase
{
    /** @test */
    public function merchant_belongs_to_user()
    {
        $merchant = Merchant::factory()->create();
        $this->assertInstanceOf(User::class, $merchant->user);
    }

    /** @test */
    public function merchant_has_products()
    {
        $user = User::factory()->create();
        $merchant = Merchant::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->create(['merchant_id' => $merchant->id]);
        $this->assertInstanceOf(Merchant::class, $product->merchant);
    }
}
