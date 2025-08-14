<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Pulgada;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        $tipos = Tipo::all();
        $pulgadas = Pulgada::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();

        return view('Productos.ProductosIndex', compact('productos','tipos', 'pulgadas', 'marcas', 'modelos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos = Tipo::all();
        $pulgadas = Pulgada::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();

        return view('Productos.ProductosForm', compact('tipos','pulgadas','marcas','modelos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'tipo_id' => 'required', // puede ser ID o "nuevo"
            'pulgada_id' => 'required', // puede ser ID o "nueva"
        ]);

        // Manejo de tipo
        if ($request->tipo_id === 'nuevo') {
            $tipo = Tipo::create(['nombre' => $request->nuevo_tipo]);
            $tipo_id = $tipo->id;
        } else {
            $tipo_id = $request->tipo_id;
        }

        // Manejo de pulgadas
        if ($request->pulgada_id === 'nueva') {
            $pulgada = Pulgada::create(['valor' => $request->nueva_pulgada]);
            $pulgada_id = $pulgada->id;
        } else {
            $pulgada_id = $request->pulgada_id;
        }

        // Manejo de marca
        if ($request->marca_id === 'nueva') {
            $marca = Marca::create(['nombre' => $request->nueva_marca]);
            $marca_id = $marca->id;
        } else {
            $marca_id = $request->marca_id;
        }

        // Manejo de modelo
        if ($request->modelo_id === 'nuevo') {
            $modelo = Modelo::create([
                'nombre' => $request->nuevo_modelo,
                'marca_id' => $marca_id
            ]);
            $modelo_id = $modelo->id;
        } else {
            $modelo_id = $request->modelo_id;
        }

        // Crear producto
        Producto::create([
            'tipo_id' => $tipo_id,
            'pulgada_id' => $pulgada_id,
            'marca_id' => $marca_id,
            'modelo_id' => $modelo_id,
            'precio' => $request->precio,
            'cantidad' => $request->cantidad,
            'numero_pieza' => $request->numero_pieza,
            'descripcion' => $request->descripcion
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto registrado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
