<?php

namespace App\Http\Services;

use App\Http\Repositories\SellingRepository;
use App\Http\Repositories\VehicleRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class SellingService
{
    private SellingRepository $sellingRepo;
    private VehicleRepository $vehicleRepo;

    /*
    *
    * Initiate variables
    *
    */
    public function __construct()
    {
        $this->sellingRepo = new SellingRepository;
        $this->vehicleRepo = new VehicleRepository;
    }

    /*
    *
    * Show all sellings regardless the type
    *
    */
    public function getSelling()
    {
        return $this->sellingRepo->getAll();
    }

    /*
    *
    * Show sellings based on type
    *
    */
    public function getByType($data)
    {
        return $this->sellingRepo->getByType($data);
    }

    /*
    *
    * Show available vehicles
    *
    */
    public function getStock()
    {
        return $this->sellingRepo->getStock();
    }

    /*
    *
    * Get details from given id
    *
    */
    public function getById($id)
    {
        $data = $this->sellingRepo->getById($id);
        return $data;
    }

    /*
    *
    * Delete record
    *
    */
    public function delete($id)
    {
        $data = $this->sellingRepo->delete($id);
        return $data;
    }

    /*
    *
    * Add record
    *
    */
    public function addSelling($request)
    {
        $validator = Validator::make($request, [
            'vehicle_id' => 'required',            
            'qty' => 'required',
            'payment_method' => 'required',
            'tax' => 'required',
            'buyer_name' => 'required',
            'buyer_address' => 'required',
        ]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $vehicle = $this->vehicleRepo->getById($request['vehicle_id']);

        $request['type'] = $vehicle['type'];
        $request['total_payment'] = ($vehicle['price'] * $request['qty']) + (($vehicle['price'] * $request['tax'] / 100) * $request['qty']);

        $result = $this->sellingRepo->create($request);
        return $result;
    }

    /*
    *
    * Edit record
    *
    */
    public function editSelling($request, $id)
    {
        $validator = Validator::make($request, [
            'vehicle_id' => 'required',
            'qty' => 'required',
            'payment_method' => 'required',
            'tax' => 'required',
            'buyer_name' => 'required',
            'buyer_address' => 'required',
        ]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $vehicle = $this->vehicleRepo->getById($request['vehicle_id']);

        $request['type'] = $vehicle['type'];
        $request['total_payment'] = ($vehicle['price'] * $request['qty']) + (($vehicle['price'] * $request['tax'] / 100) * $request['qty']);
        $request['_id'] = $id;

        $result = $this->sellingRepo->edit($request);
        return $result;
    }

}