<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Services\VehicleService;
use Exception;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    private VehicleService $vehicleServ;
    
    public function __construct()
    {
        $this->vehicleServ = new VehicleService;
    }
    
    public function responseMessage($status, $message, $data, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }
    
    //
    public function showAll()
    {
        $vehicle = $this->vehicleServ->getVehicle();

        return $this->responseMessage(true, 'List of Vehicles', $vehicle, 200);
    }

    public function getById($id)
    {
        $vehicle = $this->vehicleServ->getById($id);
        return $this->responseMessage(true, 'Detail of '.$id, $vehicle, 200);
    }

    public function store(Request $request)
    {
        $req = (array) $request->all();
        try {
            $condition = true;
            $statusCode = 200;
            $message = "Successfully add data";
            $data = $this->vehicleServ->addVehicle($req);
        } catch (Exception $e) {
            $condition = false;
            $statusCode = 400;
            $message = "Failed to add data";
            $data = json_decode($e->getMessage());
        }

        return $this->responseMessage($condition, $message, $data, $statusCode);
    }

    public function update(Request $request, $id)
    {
        $vehicle = $this->vehicleServ->getById($id);

        if (!$vehicle)
        {
            return $this->responseMessage(false, 'Data not found', null, 200);
        }

        $req = (array) $request->all();

        try {
            $condition = true;
            $statusCode = 200;
            $message = "Successfully edit data";
            $data = $this->vehicleServ->editVehicle($req, $id);
        } catch (Exception $e) {
            $condition = false;
            $statusCode = 400;
            $message = "Failed to edit data";
            $data = json_decode($e->getMessage());
        }

        return $this->responseMessage($condition, $message, $data, $statusCode);
    }

    public function delete($id)
    {
        $vehicle = $this->vehicleServ->getById($id);

        if (!$vehicle)
        {
            return $this->responseMessage(false, 'Data not found', null, 200);
        }

        $this->vehicleServ->delete($id);
        return $this->responseMessage(true, 'Data of '.$id.' is deleted', null, 200);
    }
}
