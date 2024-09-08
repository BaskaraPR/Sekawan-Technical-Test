<?php

namespace App\Http\Controllers;

use App\Models\requestModel;
use App\Models\driverModel ;
use App\Models\userModel ;
use App\Models\vehicleModel ;
use App\Models\detailRequestModel;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Validator;

class requestController extends Controller
{
    // Get all requests
    public function index()
    {
        $data= requestModel::with('details')->get();
        $userData = userModel::where('roles','approver')->pluck('name','id');
        $driverData = driverModel::where('status','available')->pluck('name','id');
        $vehicleData = vehicleModel::where('status','available')->pluck('name','id');
        return view('request', compact('data', 'userData','driverData','vehicleData'));
    }

    // Get a specific request
    public function show($id)
    {
       
    }


    public function store(HttpRequest $request)
    {
        $validatedData = $request->validate([
            'id_user' => 'required',
            'id_driver' => 'required',
            'id_vehicle' => 'required',
            'fuel_usage' => 'required',
            'used_at' => 'required',
            'returned_at' => 'required', 
        ]); 

        $newRequest = requestModel::create([
            'id_user' => $validatedData['id_user'],
            'id_driver' => $validatedData['id_driver'],
            'id_vehicle' => $validatedData['id_vehicle'],
        ]);


        detailRequestModel::create([
            'id_request' => $newRequest->id,
            'fuel_usage' => $validatedData['fuel_usage'],
            'used_at' => $validatedData['used_at'],
            'returned_at' => $validatedData['returned_at']
        ]);

        vehicleModel::where('id',$validatedData['id_vehicle'])->update([
            'status'=>'pending'
        ]);

        driverModel::where('id',$validatedData['id_driver'])->update([
            'status'=>'pending'
        ]);
        return redirect()->route('request')->with('Success','Berhasil input Request');
    }

    // Update a request
    public function update(HttpRequest $request, $id,$id_driver,$id_vehicle)
    {
        $validatedData = $request->validate([
            'admin_approval'=>'required',
            'approver_approval'=>'required' 
        ]); 

        requestModel::where('id',$id)->update([
            'admin_approval' => $validatedData['admin_approval'],
            'approver_approval' => $validatedData['approver_approval'],
        ]);

        if($validatedData['admin_approval'] == 'approved'&& $validatedData['approver_approval'] == 'approved'){
            requestModel::where('id',$id)->update([
                'status'=>'approved'
            ]);
            driverModel::where('id',$id_driver)->update([
                'status'=>'unavailable'
            ]);
            vehicleModel::where('id',$id_vehicle)->update([
                'status'=>'unvailable'
            ]);
        }

        if($validatedData['admin_approval'] == 'rejected'&& $validatedData['approver_approval'] == 'rejected'){
            requestModel::where('id',$id)->update([
                'status'=>'rejected'
            ]);
            driverModel::where('id',$id_driver)->update([
                'status'=>'available'
            ]);
            vehicleModel::where('id',$id_vehicle)->update([
                'status'=>'available'
            ]);
        }
        return redirect()->route('request')->with('Success','Berhasil Update');
    }

    // Delete a request
    public function destroy($id,$id_driver,$id_vehicle)
    {
        requestModel::where('id',$id)->delete();
        driverModel::where('id',$id_driver)->update([
            'status'=>'available'
        ]);
        vehicleModel::where('id',$id_vehicle)->update([
            'status'=>'available'
        ]);
        return redirect()->route('request')->with('Success','Berhasil delete data');
    }
}
