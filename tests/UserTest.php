<?php

namespace CCUPLUS\EloquentORM\Tests;

use CCUPLUS\EloquentORM\User;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    public function testApiTokenAttribute(): void
    {
        $token = Str::random(16);

        $user = User::query()->make([
            'token' => $token,
        ]);

        $this->assertStringContainsString($token, $user->api_token);

        $this->assertStringContainsString('.', $user->api_token);
    }
}
