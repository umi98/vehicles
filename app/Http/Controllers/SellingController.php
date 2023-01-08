<?php

namespace App\Http\Controllers;

use App\Http\Services\SellingService;
use Exception;
use Illuminate\Http\Request;

class SellingController extends Controller
{
    public SellingService $sellingServ;

    /*
    *
    * Initiate variables
    *
    */
    public function __construct()
    {
        $this->sellingServ = new SellingService;
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
    * Show all sellings regardless the type
    *
    */
    public function showAll()
    {
        $selling = $this->sellingServ->getSelling();
        return $this->responseMessage(true, 'List of Sellings', $selling, 200);
    }

    /*
    *
    * Show sellings based on type
    *
    */
    public function getByMotor()
    {
        $selling = $this->sellingServ->getByType('motorcycle');
        return $this->responseMessage(true, 'List of motorcycle selling', $selling, 200);
    }

    public function getByCar()
    {
        $selling = $this->sellingServ->getByType('car');
        return $this->responseMessage(true, 'List of motorcycle selling', $selling, 200);
    }

    /*
    *
    * Show available stock
    *
    */
    public function getStock()
    {
        $selling = $this->sellingServ->getStock();
        return $this->responseMessage(true, 'Available Vehicles', $selling, 200);
    }

    /*
    *
    * Get details from given id
    *
    */
    public function getById($id)
    {
        $selling = $this->sellingServ->getById($id);
        return $this->responseMessage(true, 'Detail of '.$id, $selling, 200);
    }

    /*
    *
    * Check if given id exists
    *
    */
    public function checkAvailable($id)
    {
        $selling = $this->sellingServ->getById($id);
        if (!$selling)
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
        $this->sellingServ->delete($id);
        return $this->responseMessage(true, 'Data of '.$id.' is deleted', null, 200);
    }

    /*
    *
    * Add record
    *
    */
    public function store(Request $request)
    {
        $req = (array) $request->all();
        try {
            $condition = true;
            $statusCode = 200;
            $message = "Successfully add data";
            $data = $this->sellingServ->addSelling($req);
        } catch (Exception $e) {
            $condition = false;
            $statusCode = 400;
            $message = "Failed to add data";
            $data = json_decode($e->getMessage());
        }

        return $this->responseMessage($condition, $message, $data, $statusCode);
    }

    /*
    *
    * Edit record
    *
    */
    public function update(Request $request, $id)
    {
        $this->checkAvailable($id);

        $req = (array) $request->all();

        try {
            $condition = true;
            $statusCode = 200;
            $message = "Successfully edit data";
            $data = $this->sellingServ->editSelling($req, $id);
        } catch (Exception $e) {
            $condition = false;
            $statusCode = 400;
            $message = "Failed to edit data";
            $data = json_decode($e->getMessage());
        }

        return $this->responseMessage($condition, $message, $data, $statusCode);
    }
}
