<?php

namespace App\Http\Repositories;

use App\Models\Vehicle;

class CarRepository
{
	/*
    *
    * Add record
    *
    */
	public function create($data)
	{
		$car = New Vehicle();
		$detail = [
			'machine' => $data['machine'],            
            'passanger_number' => $data['passanger_number'],
            'style' => $data['style'],
		];

		$car->brand = $data['brand'];
		$car->manufacturer = $data['manufacturer'];
		$car->price = $data['price'];
		$car->color = $data['color'];
		$car->year = $data['year'];
		$car->qty = $data['qty'];
		$car->type = $data['type'];
		$car->detail = $detail;

		$car->save();

		$entry = Vehicle::latest('_id')->first();
		return $entry;
	}

	/*
    *
    * Edit record
    *
    */
	public function edit($data)
	{
		$vehicle = Vehicle::find($data['_id']);

		$detail = [
			'machine' => $data['machine'],            
            'passanger_number' => $data['passanger_number'],
            'style' => $data['style'],
		];

		$vehicle->brand = $data['brand'];
		$vehicle->manufacturer = $data['manufacturer'];
		$vehicle->price = $data['price'];
		$vehicle->color = $data['color'];
		$vehicle->year = $data['year'];
		$vehicle->qty = $data['qty'];
		$vehicle->type = $data['type'];
		$vehicle->detail = $detail;

		$vehicle->save();

		$entry = Vehicle::find($data['_id']);
		return $entry;
	}

}