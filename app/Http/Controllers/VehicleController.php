<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\Vehicle;

class VehicleController extends Controller
{
    public $response =[
        'status' => 'error',
        'data' => [],
        'message' => 'An error has occurred'
    ];

    //return all registers
    public function index()
    {
        try{
            $vehicle = Vehicle::all();
            $this->response['status'] = 'success';
            $this->response['data'] = $vehicle;
            $this->response['message'] = 'Request executed';
            
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
       
    }

    //Save vehicles
    public function store(Request $request)
    {
        try{
            $vehicle = new Vehicle();
            $vehicle->license_plate = $request->license_plate;
            $vehicle->type_vehicle_id = $request->type_vehicle_id;
            $vehicle->status = $request->status;
            $vehicle->save();
            
            $this->response['status'] = 'success';
            $this->response['data'] = $vehicle;
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
            $vehicle =  Vehicle::find($id);
            
            $this->response['status'] = 'success';
            $this->response['data'] = $vehicle;
            $this->response['message'] = 'Request executed';
            
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    
    //update register by id
    public function update(Request $request, $id)
    {
        try{
            $vehicle =  Vehicle::findOrFail($request->id);
            $vehicle->license_plate = $request->license_plate;
            $vehicle->type_vehicle_id = $request->type_vehicle_id;
            $vehicle->status = $request->status;
            $vehicle->save();

            $this->response['status'] = 'success';
            $this->response['data'] = $vehicle;
            $this->response['message'] = 'Request executed';
            
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function upgrade(Request $request)
    {
        try{
            $vehicle = Vehicle::where("license_plate", $request->license_plate)->first();
            if($vehicle){
                $consult = Vehicle::where("license_plate", $request->license_plate)->update(["type_vehicle_id" => $request->type_vehicle_id]);
                $vehicle = Vehicle::where("license_plate", $request->license_plate)->first();

                $this->response['status'] = 'success';
                $this->response['data'] = $vehicle;
                $this->response['message'] = 'Request executed';

            }else{
                $this->response['status'] = 'error';
                $this->response['message'] = 'Vehicle not found';
            }
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    //delete register by id
    public function destroy($id)
    {
        try{
            $vehicle = Vehicle::destroy($id);

            $this->response['status'] = 'success';
            $this->response['data'] = $vehicle;
            $this->response['message'] = 'Request executed';
            
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
}
