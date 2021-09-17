<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Merchant;
use Facades\Tests\Setup\MerchantSetupFactory;

class ProductFeatureTest extends TestCase
{
    /** @test */
    public function only_the_owner_of_a_merchant_can_create_a_product()
    {
        // $this->withoutExceptionHandling();

        // login first
        $this->signIn();

        // go to profile page [ manage products ]
        $this->get(route("profile"))->assertStatus(200);

        // create merchant and assign it to logged user
        $merchant = Merchant::factory()->create(['user_id' => User::factory()]);

        $attributes = [
            "name"        => "name  name",
            "description" => "description  description",
            "price"       => 10
        ];

        $this->post(route("products.store", $merchant), $attributes)->assertStatus(403);

        $this->assertDataBaseMissing("products", $attributes);
    }

    /** @test */
    public function create_product_require_name_and_description_and_price()
    {
        // $this->withoutExceptionHandling();

        $this->signIn();

        $merchant = MerchantSetupFactory::create();

        $attributes = Product::factory()->raw([
            "name"        => "",
            "description" => "",
            "price"       => "",
        ]);

        $this->post(route("products.store", $merchant), $attributes)
            ->assertSessionHasErrors("name")
            ->assertSessionHasErrors("description")
            ->assertSessionHasErrors("price")
            ;
    }

    /** @test */
    public function authenticated_merchant_can_create_a_product()
    {
        $user = $this->signIn();

        $this->get(route("profile"))->assertStatus(200);

        $merchant = MerchantSetupFactory::ownedBy($user)->create();

        $product = Product::factory()->create([
            'merchant_id' => $merchant->id
        ]);

        $this->post(route("products.store", $product));

        $this->assertDatabaseHas("products", $product->toArray());

    }

    /** @test */
    public function authenticated_merchant_can_delete_a_product()
    {
        $user = $this->signIn();

        $this->get(route("profile"))->assertStatus(200);

        $merchant = MerchantSetupFactory::ownedBy($user)->create();

        $product = Product::factory()->create([
            'merchant_id' => $merchant->id
        ]);

        $this
            ->delete(route("products.destroy", $product));

        $this->assertDeleted("products", $product->toArray());

    }

}
