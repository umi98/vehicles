<?php

namespace App\Http\Repositories;

use App\Models\Motor;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class MotorRepository
{
	public function getAll()
	{
		$motor = DB::table('detail_motor')
                ->join('vehicle', '_id', '=', 'vehicle_id')
                ->select('vehicle.*', 'detail_motor.machine', 'detail_motor.suspension_front', 'detail_motor.suspension_back', 'detail_motor.transmission')
                ->get();
		return $motor;
	}

	public function create($data)
	{
		$motor = New Motor();

        $vehicle_id = Vehicle::latest('_id')->first();
        $id = $vehicle_id['_id'];

		$motor->vehicle_id = $id;
        $motor->machine = $data['machine'];
		$motor->suspension_front = $data['suspension_front'];
		$motor->suspension_back = $data['suspension_back'];
		$motor->transmission = $data['transmission'];

		$motor->save();

		$entry = Motor::latest('_id')->first();
		return $entry;
	}

	public function edit($data)
	{
		$motor = $this->getById($data['_id']);

		$motor->machine = $data['machine'];
		$motor->suspension_front = $data['suspension_front'];
		$motor->suspension_back = $data['suspension_back'];
		$motor->transmission = $data['transmission'];

		$motor->save();

		$entry = $this->getById($data['_id']);
		return $entry;
	}

	public function getById($id)
	{
		$motor = Motor::find($id);
		return $motor;
	}

	public function delete($id)
	{
		$motor = Motor::find($id);
		$motor->delete();
		return $id;
	}
}