<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class MotorTest extends TestCase
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
            'brand' => 'XXX',            
            'manufacturer' => 'YYY',
            'price' => 12000000,
            'color' => 'Read',
            'year' => '2020',
            'qty' => 1,
            'type' => 'motorcycle',
            'detail' => [
                'machine' => 'DDD',
                'suspension_front' => 'AAA',
                'suspension_back' => 'ZZZ',
                'transmission' => 'VVV',
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
     * Test motor.show route
     * 
     * Return status 200
     */
    public function test_show_motors()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('GET', route('motor.show'));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test motor.detail route
     * 
     * Return status 200
     */
    public function test_show_detail()
    {
        $token = $this->authenticate();

        $id = "63b92c21628ee2758e0a764d";
        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('GET', route('motor.detail',['id' => $id]));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test motor.delete route
     * 
     * Return status 200
     */
    public function test_delete()
    {
        $token = $this->authenticate();
        $id = $this->create_dummy();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('DELETE', route('motor.delete',['id' => $id]));
        $response->assertStatus(200);

        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test motor.create route
     * 
     * Return status 200
     */
    public function test_create()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('POST', route('motor.store'), [
                'brand' => 'XXX',            
                'manufacturer' => 'YYY',
                'price' => 12000000,
                'color' => 'Read',
                'year' => '2020',
                'qty' => 1,
                'type' => 'motorcycle',
                'machine' => 'DDD',
                'suspension_front' => 'AAA',
                'suspension_back' => 'ZZZ',
                'transmission' => 'VVV',
            ]);
        $response->assertStatus(200);

        $dummy = Vehicle::latest('_id')->first();
        $dummy->delete();
        User::where('email','test@yahoo.com')->delete();
    }

    /**
     * Test motor.update route
     * 
     * Return status 200
     */
    public function test_update()
    {
        $token = $this->authenticate();
        $id = $this->create_dummy();

        $response = $this->withHeaders([
                'Authorization' => 'Bearer '.$token,
            ])->json('POST', route('motor.update', ['id' => $id['_id']]),[
                'brand' => 'XX',            
                'manufacturer' => 'YY',
                'price' => 12000001,
                'color' => 'Red',
                'year' => '2030',
                'qty' => 1,
                'type' => 'motorcycle',
                'machine' => 'SDD',
                'suspension_front' => 'AAA',
                'suspension_back' => 'ZZZ',
                'transmission' => 'VVV',
            ]);
        $response->assertStatus(200);

        $dummy = Vehicle::latest('_id')->first();
        $dummy->delete();
        User::where('email','test@yahoo.com')->delete();
    }
}
