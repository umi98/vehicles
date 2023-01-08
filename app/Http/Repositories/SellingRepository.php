<?php

namespace App\Http\Repositories;

use App\Models\Selling;
use App\Models\Vehicle;

class SellingRepository
{
	/*
    *
    * Get all records without filltering
    *
    */
	public function getAll()
	{
		$vehicle = Selling::query()
					->get();
		return $vehicle;
	}

	/*
    *
    * Get all records with filtering on type attribute
    *
    */
	public function getByType($data)
	{
		$vehicle = Selling::query()
				-> where('type', '=', $data)
				-> get();
		return $vehicle;
	}

    /*
    *
    * Get all available stock from vehicle table
    *
    */
	public function getStock()
	{
		$vehicle = Vehicle::query()
				-> where('qty', '!=', 0)
				-> get();
		return $vehicle;
	}

	/*
    *
    * Get record from id
    *
    */
	public function getById($id)
	{
		$vehicle = Selling::find($id);
		return $vehicle;
	}

	/*
    *
    * Delete record from id
    *
    */
	public function delete($id)
	{
		$vehicle = Selling::find($id);
		$vehicle->delete();
		return $id;
	}
	
	/*
    *
    * Add record
    *
    */
	public function create($data)
	{
        $vehicle = New Selling();

		$buyer = [
			'name' => $data['buyer_name'],            
            'address' => $data['buyer_address'],
		];

		$vehicle->vehicle_id = $data['vehicle_id'];
		$vehicle->type = $data['type'];
		$vehicle->qty = $data['qty'];
		$vehicle->tax = $data['tax'];
		$vehicle->total_payment = $data['total_payment'];
		$vehicle->payment_method = $data['payment_method'];
		$vehicle->buyer = $buyer;

		$vehicle->save();
        $this->substractStock($data['vehicle_id'], $data['qty']);

		$entry = Selling::latest('_id')->first();
		return $entry;
	}

    /* 
    *
    * Substract qty in vehicle when selling took place
    *
    */
    public function substractStock($id, $qty)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->qty -= $qty;
        $vehicle->save();
    }

	/*
    *
    * Edit record
    *
    */
	public function edit($data)
	{
        $vehicle = Selling::find($data['_id']);

        $buyer = [
			'name' => $data['buyer_name'],            
            'address' => $data['buyer_address'],
		];

		$vehicle->vehicle_id = $data['vehicle_id'];
		$vehicle->type = $data['type'];
		$vehicle->tax = $data['tax'];
		$vehicle->total_payment = $data['total_payment'];
		$vehicle->payment_method = $data['payment_method'];
		$vehicle->buyer = $buyer;

        $vehicle->save();

		$entry = Selling::find($data['_id']);
		return $entry;
	}

}