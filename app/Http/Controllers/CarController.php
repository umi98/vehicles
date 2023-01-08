<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VehicleController;
use App\Http\Services\CarService;
use Exception;
use Illuminate\Http\Request;

class CarController extends VehicleController
{
    private CarService $carServ;
    private VehicleController $vehicleController;
    
    /*
    *
    * Initiate variables
    *
    */
    public function __construct()
    {
        $this->carServ = new CarService;
        $this->vehicleController = new VehicleController;
    }

    /*
    *
    * Get all cars
    *
    */
    public function getCar()
    {
        return $this->vehicleController->getByType('car');
    }

    /*
    *
    * Get details of record based on id
    *
    */
    public function getById($id)
    {
        return $this->vehicleController->getById($id);
    }

    /*
    *
    * Delete record
    *
    */
    public function delete($id)
    {
        return $this->vehicleController->delete($id);
    }

    /*
    *
    * Add record
    *
    */
    public function addCar(Request $request)
    {
        $req = (array) $request->all();
        try {
            $condition = true;
            $statusCode = 200;
            $message = "Successfully add data";
            $data = $this->carServ->addCar($req);
        } catch (Exception $e) {
            $condition = false;
            $statusCode = 400;
            $message = "Failed to add data";
            $data = json_decode($e->getMessage());
        }

        return $this->vehicleController->responseMessage($condition, $message, $data, $statusCode);
    }

    /*
    *
    * Update record
    *
    */
    public function update(Request $request, $id)
    {
        $this->vehicleController->checkAvailable($id);

        $req = (array) $request->all();

        try {
            $condition = true;
            $statusCode = 200;
            $message = "Successfully edit data";
            $data = $this->carServ->editCar($req, $id);
        } catch (Exception $e) {
            $condition = false;
            $statusCode = 400;
            $message = "Failed to edit data";
            $data = json_decode($e->getMessage());
        }

        return $this->vehicleController->responseMessage($condition, $message, $data, $statusCode);
    }
}
