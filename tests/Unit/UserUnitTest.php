<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Merchant;

class UserUnitTest extends TestCase
{
    /** @test */
    public function user_has_merchant()
    {
        $user = User::factory()->create();
        $merchant = Merchant::factory()->create(['user_id' => $user->id]);
        $this->assertInstanceOf(Merchant::class, $user->merchant);
    }
}
