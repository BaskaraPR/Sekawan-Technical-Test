<?php

namespace App\Http\Controllers;

use App\Models\userModel;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data= userModel::orderBy('name','asc')->get();
        return view('user', compact('data'));
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
        $validatedData = $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email',
            'password' => 'required|string|min:7',
            'roles' => 'required|string|in:admin,approver', 
        ]);
    
        userModel::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'roles' => $validatedData['roles'], 
        ]);

        return redirect()->route('user')->with('Success','Berhasil input');
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
        $validatedData = $request->validate([
            'name' => 'required|string|min:4',
            'email' => 'required|email',
            'password' => 'required|string|min:7',
            'roles' => 'required|string|in:admin,approver', 
        ]);
    
        userModel::where('id',$id)->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'roles' => $validatedData['roles'], 
        ]);

        return redirect()->route('user')->with('Success','Berhasil Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        userModel::where('id',$id)->delete();
        return redirect()->route('user')->with('Success','Berhasil delete data');
    }
}
