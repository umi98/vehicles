<?php

namespace App\Http\Repositories;

use App\Models\Vehicle;

class VehicleRepository
{
	public function getAll()
	{
		$vehicle = Vehicle::query()
					->get();
		return $vehicle;
	}

	public function create($data)
	{
		$vehicle = New Vehicle();

		$vehicle->brand = $data['brand'];
		$vehicle->manufacturer = $data['manufacturer'];
		$vehicle->price = $data['price'];
		$vehicle->color = $data['color'];
		$vehicle->year = $data['year'];
		$vehicle->qty = $data['qty'];
		$vehicle->type = $data['type'];

		$vehicle->save();

		$entry = Vehicle::latest('_id')->first();
		return $entry;
	}

	public function edit($data)
	{
		$vehicle = $this->getById($data['_id']);

		$vehicle->brand = $data['brand'];
		$vehicle->manufacturer = $data['manufacturer'];
		$vehicle->price = $data['price'];
		$vehicle->color = $data['color'];
		$vehicle->year = $data['year'];
		$vehicle->qty = $data['qty'];
		$vehicle->type = $data['type'];

		$vehicle->save();

		$entry = $this->getById($data['_id']);
		return $entry;
	}

	public function getById($id)
	{
		$vehicle = Vehicle::find($id);
		return $vehicle;
	}

	public function delete($id)
	{
		$vehicle = Vehicle::find($id);
		$vehicle->delete();
		return $id;
	}
}