<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CarTest extends TestCase
{    
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
            'brand' => 'XXX',            
            'manufacturer' => 'YYY',
            'price' => 12000000,
            'color' => 'Read',
            'year' => '2020',
            'qty' => 1,
            'type' => 'car',
            'detail' => [
                'machine' => 'DDD',
                'passanger_number' => 12,
                'style' => 'ZZZ'
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
        Vehicle::create($data);
        $id = Vehicle::latest('_id')->first();
        return $id;
    }

    /**
     * Test car.show route
     * 
     * Return status 200
     */
    public function test_show_cars()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('GET', route('car.show'));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    public function test_show_detail()
    {
        $token = $this->authenticate();

        $id = "63baabc23ef16190080777a4";
        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('GET', route('car.detail',['id' => $id]));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test car.delete route
     * 
     * Return status 200
     */
    public function test_delete()
    {
        $token = $this->authenticate();
        $id = $this->create_dummy();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('DELETE', route('car.delete',['id' => $id]));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test car.create route
     * 
     * Return status 200
     */
    public function test_create()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('POST', route('car.store'), [
                'brand' => 'XXX',            
                'manufacturer' => 'YYY',
                'price' => 12000000,
                'color' => 'Read',
                'year' => '2020',
                'qty' => 1,
                'type' => 'car',
                'machine' => 'DDD',
                'passanger_number' => 12,
                'style' => 'ZZZ'
            ]);
        $response->assertStatus(200);

        $dummy = Vehicle::latest('_id')->first();
        $dummy->delete();
        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test car.update route
     * 
     * Return status 200
     */
    public function test_update()
    {
        $token = $this->authenticate();
        $id = $this->create_dummy();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('POST', route('car.update', ['id' => $id['_id']]),[
                'brand' => 'XX',            
                'manufacturer' => 'YY',
                'price' => 12000001,
                'color' => 'Red',
                'year' => '2030',
                'qty' => 1,
                'type' => 'car',
                'machine' => 'SDD',
                'passanger_number' => 12,
                'style' => 'ZZZ'
            ]);
        $response->assertStatus(200);

        $dummy = Vehicle::latest('_id')->first();
        $dummy->delete();
        User::where('email','test@yahoo.com')->delete();
    }
}
