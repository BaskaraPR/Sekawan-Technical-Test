<?php

namespace App\Http\Controllers;

use App\Models\driverModel;
use Illuminate\Http\Request;

class driverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data= driverModel::orderBy('name','asc')->get();
        return view('driver', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'name' => 'required|string|min:4',
            'status' => 'required|string|in:available,unavailable', 
        ]);
    
        driverModel::create([
            'name' => $validatedData['name'],
            'status' => $validatedData['status'], 
        ]);

        return redirect()->route('driver')->with('Success','Berhasil input');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validatedData = $request->validate([
           'name' => 'required|string|min:4',
           'status' => 'required|string|in:available,unavailable', 
        ]);
    
        driverModel::where('id',$id)->update([
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('driver')->with('Success','Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        driverModel::where('id',$id)->delete();
        return redirect()->route('driver')->with('Success','Berhasil delete data');
    }
}
