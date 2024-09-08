<?php

namespace App\Http\Controllers;

use App\Models\vehicleModel;
use Illuminate\Http\Request;

class vehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= vehicleModel::orderBy('name','asc')->get();
        return view('vehicle', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:4',
            'licensePlate' => 'required|string|min:5|max:7',
            'description' => 'required|string|max:225',
            'ownership' => 'required|string|in:owned,third_party',
            'type' => 'required|string|in:cargo,passenger',
            'status' => 'required|string|in:available,unavailable,pending', 
        ]);
    
        vehicleModel::create([
            'name' => $validatedData['name'],
            'licensePlate' => $validatedData['licensePlate'],
            'description' => $validatedData['description'],
            'ownership'=>$validatedData['ownership'],
            'type'=>$validatedData['type'],
            'status'=>$validatedData['status']
        ]);

        return redirect()->route('vehicle')->with('Success','Berhasil input');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:4',
            'licensePlate' => 'required|string|min:5|max:7',
            'description' => 'required|string|max:225',
            'ownership' => 'required|string|in:owned,third_party',
            'type' => 'required|string|in:cargo,passenger',
            'status' => 'required|string|in:available,unavailable,pending', 
        ]);
    
        vehicleModel::where('id',$id)->update([
            'name' => $validatedData['name'],
            'licensePlate' => $validatedData['licensePlate'],
            'description' => $validatedData['description'],
            'ownership'=>$validatedData['ownership'],
            'type'=>$validatedData['type'],
            'status'=>$validatedData['status']
        ]);

        return redirect()->route('vehicle')->with('Success','Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        vehicleModel::where('id',$id)->delete();
        return redirect()->route('vehicle')->with('Success','Berhasil delete data');
    }
}
