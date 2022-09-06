<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\TypeVehicle;



class TypeVehicleController extends Controller
{
    public $response =[
        'status' => 'error',
        'data' => [],
        'message' => 'An error has occurred'
    ];

    public function index()
    {
        try {
            $typeVehicle = TypeVehicle::all();
            $this->response['status'] = 'success';
            $this->response['data'] = $typeVehicle;
            $this->response['message'] = 'Request executed';
            
            return response()->json($this->response, 200);

           } catch (Exception $e) {
               return response()->json(['error' => $e->getMessage()], 500);
           }
    }
 
    //Save TypeVehicles
    public function store(Request $request)
    {
        try {
                $typeVehicle = new TypeVehicle();
                $typeVehicle->name = $request->name;
                $typeVehicle->description = $request->description;
                $typeVehicle->save();

                $this->response['status'] = 'success';
                $this->response['data'] = $typeVehicle;
                $this->response['message'] = 'Request executed';
            
                return response()->json($this->response, 200);
            } catch (Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }
    //Show info by id
    public function show($id)
    {
        try{
            $typeVehicle =  TypeVehicle::find($id);
            $this->response['status'] = 'success';
            $this->response['data'] = $typeVehicle;
            $this->response['message'] = 'Request executed';
            
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
    
    //update register by id
    public function update(Request $request)
    {
        try{
                $typeVehicle =  TypeVehicle::findOrFail($request->id);
                $typeVehicle->name = $request->name;
                $typeVehicle->description = $request->description;
                $typeVehicle->save();

                $this->response['status'] = 'success';
                $this->response['data'] = $typeVehicle;
                $this->response['message'] = 'Request executed';

            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
 
    //delete register by id
    public function destroy($id)
    {
        try{
            $typeVehicle = TypeVehicle::destroy($id);
            
            $this->response['status'] = 'success';
            $this->response['data'] = $typeVehicle;
            $this->response['message'] = 'Request executed';
            
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
}
