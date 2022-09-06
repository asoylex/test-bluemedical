<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\MonthTime;
use Illuminate\Support\Facades\DB;

class MonthTimeController extends Controller
{
    public $response =[
        'status' => 'error',
        'data' => [],
        'message' => 'An error has occurred'
    ];

    public function index()
    {
        try{
            $monthTime = MonthTime::all();

            $this->response['status'] = 'success';
            $this->response['data'] = $monthTime;
            $this->response['message'] = 'Request executed';
        
            return response()->json($this->response, 200);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }
 
    //Save MonthTime
    public function store(Request $request)
    {
        try{
            $monthTime = new MonthTime();
            $monthTime->vehicle_id = $request->vehicle_id;
            $monthTime->total_min= $request->total_min;
            $monthTime->save();
 
            $this->response['status'] = 'success';
            $this->response['data'] = $monthTime;
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
            $monthTime =  MonthTime::find($id);

            $this->response['status'] = 'success';
            $this->response['data'] = $monthTime;
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
            $monthTime = MonthTime::findOrFail($request->id);
            $monthTime->vehicle_id = $request->vehicle_id;
            $monthTime->total_min = $request->total_min;
            $monthTime->save();
     
            $this->response['status'] = 'success';
            $this->response['data'] = $monthTime;
            $this->response['message'] = 'Request executed';
        
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
      
    }
    public function paymentReport()
    {
        try{
            $payment = DB::table('month_time')->join('vehicle', function ($join) {
                $join->on('month_time.vehicle_id', '=', 'vehicle.id')
                     ->where('vehicle.type_vehicle_id', '=', 2);
            })->get();

            $this->response['status'] = 'success';
            $this->response['data'] = $payment;
            $this->response['message'] = 'Request executed';
        
            return response()->json($this->response, 200);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function cleanMonth()
    {
        try{
            
            
            $month= MonthTime::query()->update(['total_min' => 0]);
      

            $this->response['status'] = 'success';
            $this->response['data'] = [];
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
            $monthTime = MonthTime::destroy($id);

            $this->response['status'] = 'success';
            $this->response['data'] = $monthTime;
            $this->response['message'] = 'Request executed';
        
            return response()->json($this->response, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }
}
