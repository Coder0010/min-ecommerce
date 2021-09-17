<?php

namespace Tests\Setup;

use App\Models\User;
use App\Models\Product;
use App\Models\Merchant;

class MerchantSetupFactory
{

    protected $user;

    protected $productsCount = 0;

    public function ownedBy($user)
    {
        $this->user = $user;

        return $this;
    }

    public function withProduct($count)
    {
        $this->productsCount = $count;

        return $this;
    }

    public function create()
    {
        $user = User::factory()->create();

        $merchant = Merchant::factory()->create([
            "user_id" => $this->user ?? $user,
        ]);
        // \Log::info($user);
        // \Log::info($merchant);
        if($this->productsCount){
            $product = Product::factory()->count($this->productsCount)->create([
                "merchant_id" => $merchant,
            ]);
            // \Log::info($product);
        }


        return $merchant;
    }

}
