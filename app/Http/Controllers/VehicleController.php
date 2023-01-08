<?php

namespace App\Http\Controllers;

use App\Http\Services\VehicleService;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public VehicleService $vehicleServ;

    /*
    *
    * Initiate variables
    *
    */
    public function __construct()
    {
        $this->vehicleServ = new VehicleService;
    }
    
    /*
    *
    * Response message
    *
    */
    public function responseMessage($status, $message, $data, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
    
    /*
    *
    * Show all vehicles regardless the type
    *
    */
    public function showAll()
    {
        $vehicle = $this->vehicleServ->getVehicle();
        return $this->responseMessage(true, 'List of Vehicles', $vehicle, 200);
    }

    /*
    *
    * Show vehicles based on type
    *
    */
    public function getByType($type)
    {
        $vehicle = $this->vehicleServ->getByType($type);
        return $this->responseMessage(true, 'List of '.$type, $vehicle, 200);
    }

    /*
    *
    * Get details from given id
    *
    */
    public function getById($id)
    {
        $vehicle = $this->vehicleServ->getById($id);
        return $this->responseMessage(true, 'Detail of '.$id, $vehicle, 200);
    }

    /*
    *
    * Check if given id exists
    *
    */
    public function checkAvailable($id)
    {
        $vehicle = $this->vehicleServ->getById($id);
        if (!$vehicle)
        {
            return $this->responseMessage(false, 'Data not found', null, 200);
        }
    }

    /*
    *
    * Delete record
    *
    */
    public function delete($id)
    {
        $this->checkAvailable($id);
        $this->vehicleServ->delete($id);
        return $this->responseMessage(true, 'Data of '.$id.' is deleted', null, 200);
    }

    /*
    *
    * Add record
    * This section was emptied since each type of vehicles had their own input
    * Add and edit record code are written in Motor Class and Car Class
    *
    */
    public function store(Request $request)
    {
    }

    /*
    *
    * Add record
    * This section was emptied since each type of vehicles had their own input
    * Add and edit record code are written in Motor Class and Car Class
    *
    */
    public function update(Request $request, $id)
    {
    }


}
