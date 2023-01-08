<?php

namespace App\Http\Services;

use App\Http\Repositories\CarRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CarService
{
    private CarRepository $carRepo;

    /*
    *
    * Initiate variables
    *
    */
    public function __construct()
    {
        $this->carRepo = new CarRepository;
    }

    /*
    *
    * Add record
    *
    */
    public function addCar($request)
    {
        $validator = Validator::make($request, [
            'brand' => 'required',            
            'manufacturer' => 'required',
            'price' => 'required|integer',
            'color' => 'required',
            'year' => 'required',
            'qty' => 'required|integer',
            'type' => 'required',
            'machine' => 'required',            
            'passanger_number' => 'required',
            'type' => 'required',
        ]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $result = $this->carRepo->create($request);
        return $result;
    }

    /*
    *
    * Edit record
    *
    */
    public function editCar($request, $id)
    {
        $validator = Validator::make($request, [
            'brand' => 'required',            
            'manufacturer' => 'required',
            'price' => 'required|integer',
            'color' => 'required',
            'year' => 'required',
            'qty' => 'required|integer',
            'type' => 'required',
            'machine' => 'required',            
            'passanger_number' => 'required',
            'style' => 'required',
        ]);
        
        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $request['_id'] = $id;
        $data = $this->carRepo->edit($request);

        return $data;
    }

}