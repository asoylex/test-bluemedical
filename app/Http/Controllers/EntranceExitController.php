<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\EntranceExit;
use App\Models\Vehicle;
use  App\Models\MonthTime;
use Carbon\Carbon;

class EntranceExitController extends Controller
{
    public $response =[
        'status' => 'error',
        'data' => [],
        'message' => 'An error has occurred'
    ];

   public function index()
   {
        try{
            $entranceExit = EntranceExit::all();

            $this->response['status'] = 'success';
            $this->response['data'] = $entranceExit;
            $this->response['message'] = 'Request executed';
        
            return response()->json($this->response, 200);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
   }

   //Save Entrance Exit
   public function store(Request $request)
   {
        try{
            $entranceExit = new EntranceExit();
            $entranceExit->entrance = $request->entrance;
            $entranceExit->exit = $request->exit;
            $entranceExit->vehicle_id = $request->vehicle_id;
            $entranceExit->save();
      
            $this->response['status'] = 'success';
            $this->response['data'] = $entranceExit;
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
        $entranceExit =  EntranceExit::find($id);

        $this->response['status'] = 'success';
        $this->response['data'] = $entranceExit;
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
            $entranceExit =  EntranceExit::findOrFail($request->id);
            $entranceExit->entrance = $request->entrance;
            $entranceExit->exit = $request->exit;
            $entranceExit->vehicle_id = $request->vehicle_id;
            $entranceExit->save();
      
            $this->response['status'] = 'success';
            $this->response['data'] = $entranceExit;
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
            $entranceExit = EntranceExit::destroy($id);

            $this->response['status'] = 'success';
            $this->response['data'] = $entranceExit;
            $this->response['message'] = 'Request executed';
        
            return response()->json($this->response, 200);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
   }

   public function exit(Request $request)
   {
    try {
        $now =now();
        $vehicleId = Vehicle::where('license_plate', $request->license_plate)->first();

        
       if($vehicleId == null){
            $this->response['message'] = 'Vehicle no register';
       }else{
        $searchInfo = EntranceExit::where('vehicle_id',$vehicleId->id )->where('status', 0)->first();

        if($searchInfo == null){
            $this->response['message'] = 'Vehicle entrance no detected';
        }else{
            $entranceIsAvailable = EntranceExit::where('vehicle_id',$vehicleId->id )->where('status', 0)->latest()->first();
        $vehicle = Vehicle::where('license_plate', $request->license_plate)->first()->update(['type_vehicle_id' => $request->type_vehicle]);
        $affectedRows = EntranceExit::where("id", $entranceIsAvailable->id)->where('exit', null)->update(["exit" => $now, "status"=> 1]);
        
            if($affectedRows ){
                //dd($vehicleId);

                $newEntrance =EntranceExit::where('vehicle_id', $vehicleId->id)->latest()->first();
                //dd($newEntrance);
                $t1 = Carbon::parse($newEntrance->entrance);
                $t2 = Carbon::parse($now);
                $diff = $t1->diffInMinutes($t2);

                $monthTimeRegister = MonthTime::where('vehicle_id', $vehicleId->id)->first();

                if ($monthTimeRegister == null) {
                    $monthTime = new MonthTime();
                    $monthTime->vehicle_id = $vehicleId->id;
                    $monthTime->total_min = $diff;
                    $monthTime->save(); 
                  
                    $mounthPaymet;
                    if($request->type_vehicle == 2){
                        $mounthPaymet = $diff * 0.05;
    
                    } elseif($request->type_vehicle == 3 ){
                        $mounthPaymet = 0;
    
                    }else{
                        $mounthPaymet = $diff * 0.5;
                    }
    
                    $dataResponse = [
                        'entranceExit' => $newEntrance,
                        'monthTime' => $monthTime,
                        'mounthPaymet' => $mounthPaymet
                    ];
        
                    $this->response['status'] = 'success';
                    $this->response['data'] = $dataResponse;
                    $this->response['message'] = 'Request executed';
                }else{
                    $updateMonthTime= MonthTime::where('vehicle_id', $vehicleId->id)->first()->update(['total_min' => ($monthTimeRegister->total_min + $diff )]);
                    $monthTimeRegister = MonthTime::where('vehicle_id', $vehicleId->id)->first();

                    $mounthPaymet;
                    if($request->type_vehicle == 2){
                        $mounthPaymet = $diff * 0.05;
    
                    } elseif($request->type_vehicle == 3 ){
                        $mounthPaymet = 0;
    
                    }else{
                        $mounthPaymet = $diff * 0.5;
                    }
    
                    $dataResponse = [
                        'entranceExit' => $newEntrance,
                        'monthTime' => $monthTimeRegister,
                        'mounthPaymet' => $mounthPaymet
                    ];
        
                    $this->response['status'] = 'success';
                    $this->response['data'] = $dataResponse;
                    $this->response['message'] = 'Request executed';

                }
            }
        }    

       }

      
        return response()->json($this->response, 200);
      
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
    
   }

   public function entrance(Request $request)
   {
    try {
        $now=now();
        $vehicle = Vehicle::where('license_plate', $request->license_plate)->first();
        $entranceIsAvailable = EntranceExit::where('exit', null)->first();
        $idVehicle;

    if ($vehicle) {
        $idVehicle = $vehicle->id;
      }else{
          $vehicle = new Vehicle();
          $vehicle->license_plate = $request->license_plate;
          $vehicle->type_vehicle_id = 1;
          $vehicle->status = 0;
          $vehicle->save();
          $idVehicle =$vehicle->id;

      }

      if ($entranceIsAvailable) {
            $this->response['status'] = 'error';
            $this->response['data'] = [];
            $this->response['message'] = 'already use the entrance';
            return response()->json($this->response, 200);
      } else {
      
            $entranceExit = new EntranceExit();
            $entranceExit->entrance = $now;
            $entranceExit->vehicle_id = $idVehicle;
            $entranceExit->save();
    
            $this->response['status'] = 'success';
            $this->response['data'] = $entranceExit;
            $this->response['message'] = 'Request executed';
            return response()->json($this->response, 200);
      }
      
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
    
   }

}
