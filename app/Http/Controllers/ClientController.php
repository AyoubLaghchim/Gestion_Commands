<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients = Client::all();
        return view('admin.clients.index',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $client = Client::create($request->all());
        return redirect()->Route('clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $client = Client::findOrFail($id);
        return view('admin.clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(client  $client)
    {
        //
        return view('admin.clients.edit' ,compact('client'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return redirect()->Route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->Route('clients.index');
    }
}
