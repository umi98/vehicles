<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VehicleController;
use App\Http\Services\MotorService;
use Exception;
use Illuminate\Http\Request;

class MotorController extends Controller
{
    private MotorService $motorServ;
    private VehicleController $vehicleController;
    
    public function __construct()
    {
        $this->motorServ = new MotorService;
        $this->vehicleController = new VehicleController;
    }

    //
    public function getAll()
    {
        $motors = $this->motorServ->getMotor();
        return $this->vehicleController->responseMessage(true, "List of Motors", $motors, 200);
    }

    public function addMotor(Request $request)
    {
        $parentData = [
            'brand' => $request['brand'],
            'manufacturer' => $request['manufacturer'],
            'price' => $request['price'],
            'color' => $request['color'],
            'year' => $request['year'],
            'qty' => $request['qty'],
            'type' => $request['type'],
        ];        

        $newData = new Request($parentData);
        
        $motorData = [
            'machine' => $request['machine'],
            'suspension_front' => $request['suspension_front'],
            'suspension_back' => $request['suspension_back'],
            'transmission' => $request['transmission'],
        ];
        
        try {
            $condition = true;
            $statusCode = 200;
            $message = "Successfully add data";
            $this->vehicleController->store($newData);
            $data = $this->motorServ->addMotor($motorData);
        } catch (Exception $e) {
            $condition = false;
            $statusCode = 400;
            $message = "Failed to add data";
            $data = json_decode($e->getMessage());
        }

        return $this->vehicleController->responseMessage($condition, $message, $data, $statusCode);
    }
}
