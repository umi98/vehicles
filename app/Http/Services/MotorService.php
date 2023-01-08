<?php

namespace App\Http\Services;

use App\Http\Repositories\MotorRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MotorService
{
    private MotorRepository $motorRepo;

    /*
    *
    * Initiate variables
    *
    */
    public function __construct()
    {
        $this->motorRepo = new MotorRepository;
    }

    /*
    *
    * Add record
    *
    */
    public function addMotor($request)
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
            'suspension_front' => 'required',
            'suspension_back' => 'required',
            'transmission' => 'required',
        ]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $result = $this->motorRepo->create($request);
        return $result;
    }

    /*
    *
    * Edit record
    *
    */
    public function editMotor($request, $id)
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
            'suspension_front' => 'required',
            'suspension_back' => 'required',
            'transmission' => 'required',
        ]);
        
        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $request['_id'] = $id;
        $data = $this->motorRepo->edit($request);

        return $data;
    }

}