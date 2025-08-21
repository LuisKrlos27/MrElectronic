<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cliente = Cliente::all();

        return view('Clientes.ClientesIndex', compact('cliente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Clientes.ClientesForm ');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'=>'required|string',
            'documento'=>'required|numeric',
            'telefono'=>'required|numeric',
            'direccion'=>'required|string'
        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index')->with('success','Cliente registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('Clientes.ClientesEdit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nombre'=>'required|string',
            'documento'=>'required|numeric',
            'telefono'=>'required|numeric',
            'direccion'=>'required|string'
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('success','Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success','Cliente eliminado correctamente');

    }
}
