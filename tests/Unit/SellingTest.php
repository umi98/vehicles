<?php

namespace Tests\Unit;

use App\Models\Selling;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class SellingTest extends TestCase
{
    /**
     * Authentication function
     * 
     * Return token
     */
    protected function authenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => 'test@yahoo.com',
            'password' => Hash::make('test')
        ]);

        $token = JWTAuth::fromUser($user);
        return $token;
    }

    /**
     * Function to keep data dummy
     * 
     * Return array
     */
    protected function data_dummy()
    {
        $data = [
            'vehicle_id' => '2',
            'type' => 'motorcycle',
            'qty' => 2,
            'payment_method' => 'credit',
            'tax' => 10,
            'total_payment' => 22000000,
            'buyer' => [
                'buyer_name' => 'Baby',
                'buyer_address' => 'Doe',
            ]            
        ];
        return $data;
    }

    /**
     * Function to create data dummy. Its record wil be deleted after performing test
     * 
     * return latest record
     */
    protected function create_dummy()
    {
        $data = $this->data_dummy();
        Selling::create($data);
        $id = Selling::latest('_id')->first();
        return $id;
    }

    /**
     * Test selling.show route
     * 
     * Return status 200
     */
    public function test_show_sellings()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('GET', route('selling.show'));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test selling.detail route
     * 
     * Return status 200
     */
    public function test_show_detail()
    {
        $token = $this->authenticate();

        $id = "63baada23ef16190080777a5";
        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('GET', route('selling.detail',['id' => $id]));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test selling.delete route
     * 
     * Return status 200
     */
    public function test_delete()
    {
        $token = $this->authenticate();
        $id = $this->create_dummy();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('DELETE', route('selling.delete',['id' => $id]));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test selling.create route
     * 
     * Return status 200
     */
    public function test_create()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('POST', route('selling.store'), [
                'vehicle_id' => '63baa95e3ef16190080777a2',
                'qty' => 1,
                'payment_method' => 'cash',
                'tax' => 5,
                'buyer_name' => 'John',
                'buyer_address' => 'Doe',
            ]);
        $response->assertStatus(200);

        $dummy = Selling::latest('_id')->first();
        $dummy->delete();
        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test selling.update route
     * 
     * Return status 200
     */
    public function test_update()
    {
        $token = $this->authenticate();
        $id = $this->create_dummy();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('POST', route('selling.update', ['id' => $id['_id']]),[
                'vehicle_id' => '63baa95e3ef16190080777a2',
                'qty' => 1,
                'payment_method' => 'cash',
                'tax' => 10,
                'buyer_name' => 'John',
                'buyer_address' => 'Doe',
            ]);
        $response->assertStatus(200);

        $dummy = Selling::latest('_id')->first();
        $dummy->delete();
        User::where('email','test@yahoo.com')->delete();
    }
}
