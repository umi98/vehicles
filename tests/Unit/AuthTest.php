<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    public $token;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_can_login()
    {
        $response = $this->json('POST', route('api.login'),[
            'email' => 'bagas@gmail.com',
            'password' => 'bagas'
        ]);
        $response->assertStatus(200);
        $this->assertArrayHasKey('access_token', $response->json());
    }

    public function test_can_logout()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@yahoo.com',
            'password' => Hash::make('test')
        ]);

        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('POST', route('api.logout'));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }
}
