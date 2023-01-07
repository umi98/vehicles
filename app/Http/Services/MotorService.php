<?php

namespace App\Http\Services;

use App\Http\Repositories\MotorRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class MotorService
{
    private MotorRepository $motorRepo;

    public function __construct()
    {
        $this->motorRepo = new MotorRepository;
    }

    public function getMotor()
    {
        return $this->motorRepo->getAll();
    }

    public function addMotor($request)
    {
        $validator = Validator::make($request, [
            'machine' => 'required',            
            'suspension_front' => 'required',
            'suspension_back' => 'required',
            'transmission' => 'required',
        ]);

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors());
        }

        $data = $this->motorRepo->create($request);

        return $data;
    }

    public function getById($id)
    {
        $data = $this->motorRepo->getById($id);
        return $data;
    }

    public function editMotor($request, $id)
    {
        $validator = Validator::make($request, [
            'vehicle_id' => 'required',
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

    public function delete($id)
    {
        $data = $this->motorRepo->delete($id);
        return $data;
    }
}