<?php

namespace App\Http\Repositories;

use App\Models\Vehicle;

class VehicleRepository
{
	/*
    *
    * Get all records without filltering
    *
    */
	public function getAll()
	{
		$vehicle = Vehicle::query()
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
		$vehicle = Vehicle::query()
				-> where('type', '=', $data)
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
		$vehicle = Vehicle::find($id);
		return $vehicle;
	}

	/*
    *
    * Delete record from id
    *
    */
	public function delete($id)
	{
		$vehicle = Vehicle::find($id);
		$vehicle->delete();
		return $id;
	}
	
	/*
    *
    * Add record
    * This section was emptied since each type of vehicles had their own input
	* Add and edit record code are written in Motor Class and Car Class
    *
    */
	public function create($data)
	{
	}

	/*
    *
    * Edit record
    * This section was emptied since each type of vehicles had their own input
	* Add and edit record code are written in Motor Class and Car Class
    *
    */
	public function edit($data)
	{
	}


}