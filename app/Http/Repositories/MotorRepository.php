<?php

namespace App\Http\Repositories;

use App\Models\Vehicle;

class MotorRepository
{
	/*
    *
    * Add record
    *
    */
	public function create($data)
	{
		$motor = New Vehicle();
		$detail = [
			'machine' => $data['machine'],            
            'suspension_front' => $data['suspension_front'],
            'suspension_back' => $data['suspension_back'],
            'transmission' => $data['transmission'],
		];

		$motor->brand = $data['brand'];
		$motor->manufacturer = $data['manufacturer'];
		$motor->price = $data['price'];
		$motor->color = $data['color'];
		$motor->year = $data['year'];
		$motor->qty = $data['qty'];
		$motor->type = $data['type'];
		$motor->detail = $detail;

		$motor->save();

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
            'suspension_front' => $data['suspension_front'],
            'suspension_back' => $data['suspension_back'],
            'transmission' => $data['transmission'],
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