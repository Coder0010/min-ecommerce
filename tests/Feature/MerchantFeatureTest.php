<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Merchant;

class MerchantFeatureTest extends TestCase
{
    /** @test */
    public function register_as_merchant_require_name_and_email_and_password()
    {
        $attributes = User::factory()->raw([
            "name"     => "",
            "email"    => "",
            "password" => "",
        ]);

        $this->post(route("register"), $attributes)
            ->assertSessionHasErrors("name")
            ->assertSessionHasErrors("email")
            ->assertSessionHasErrors("password");
    }

    /** @test */
    public function register_as_merchant()
    {
        // show register page
        $this->get(route("register"))->assertStatus(200);

        // create user [ name, email, password ]
        $user = User::factory()->create();

        // check if user is created
        $this->assertDatabaseHas("users", $user->toArray());

        // create merchant [ name, phone ] and assign this merchant to user
        $merchant = $user->merchant()->create(Merchant::factory()->raw());

        $this->assertDatabaseHas("merchants", $merchant->toArray());

    }
}
