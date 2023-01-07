<?php

namespace App\Http\Services;

use App\Http\Repositories\VehicleRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class VehicleService
{
    private VehicleRepository $vehicleRepo;

    public function __construct()
    {
        $this->vehicleRepo = new VehicleRepository;
    }

    public function getVehicle()
    {
        return $this->vehicleRepo->getAll();
    }

    public function addVehicle($request)
    {
        $validator = Validator::make($request, [
            'brand' => 'required',            
            'manufacturer' => 'required',
            'price' => 'required',
            'color' => 'required',
            'year' => 'required',
            'qty' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $data = $this->vehicleRepo->create($request);

        return $data;
    }

    public function getById($id)
    {
        $data = $this->vehicleRepo->getById($id);
        return $data;
    }

    public function editVehicle($request, $id)
    {
        $validator = Validator::make($request, [
            'brand' => 'required',            
            'manufacturer' => 'required',
            'price' => 'required',
            'color' => 'required',
            'year' => 'required',
            'qty' => 'required',
            'type' => 'required',
        ]);
        
        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $request['_id'] = $id;
        $data = $this->vehicleRepo->edit($request);

        return $data;
    }

    public function delete($id)
    {
        $data = $this->vehicleRepo->delete($id);
        return $data;
    }
}