<?php

namespace App\Http\Services;

use App\Http\Repositories\VehicleRepository;

class VehicleService
{
    private VehicleRepository $vehicleRepo;

    /*
    *
    * Initiate variables
    *
    */
    public function __construct()
    {
        $this->vehicleRepo = new VehicleRepository;
    }

    /*
    *
    * Show all vehicles regardless the type
    *
    */
    public function getVehicle()
    {
        return $this->vehicleRepo->getAll();
    }

    /*
    *
    * Show vehicles based on type
    *
    */
    public function getByType($data)
    {
        return $this->vehicleRepo->getByType($data);
    }

    /*
    *
    * Get details from given id
    *
    */
    public function getById($id)
    {
        $data = $this->vehicleRepo->getById($id);
        return $data;
    }

    /*
    *
    * Delete record
    *
    */
    public function delete($id)
    {
        $data = $this->vehicleRepo->delete($id);
        return $data;
    }

    /*
    *
    * Add record
    * This section was emptied since each type of vehicles had their own input
    * Add and edit record code are written in Motor Class and Car Class
    *
    */
    public function addVehicle($request)
    {
    }

    /*
    *
    * Edit record
    * This section was emptied since each type of vehicles had their own input
    * Add and edit record code are written in Motor Class and Car Class
    *
    */
    public function editVehicle($request, $id)
    {
    }

}