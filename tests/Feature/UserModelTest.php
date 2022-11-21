<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use WithFaker;

    public function test_new_user_store()
    {
        $user = User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ]);

        $this->assertModelExists($user);
    }


    public function test_user_exists()
    {
        $user = User::find(1);
        $this->assertModelExists($user);
    }

    public function test_user_updated()
    {
        $user = User::factory()->create();
        $user->update([
            'name' => 'Donald Blessing'
        ]);

        $this->assertEquals($user->name, 'Donald Blessing');
    }

    public function test_user_deleted()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->assertModelMissing($user);
    }

    public function test_add_user_address()
    {
        $user = User::factory()->create();
        $user->address()->create([
            'street' => fake()->address(),
            'town' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
        ]);
        $this->assertModelExists($user->address);
    }


    public function test_add_user_profile()
    {
        $user = User::factory()->create();
        $user->profile()->create([
            'description' => fake()->sentence(),
        ]);
        $this->assertModelExists($user->profile);
    }
}
