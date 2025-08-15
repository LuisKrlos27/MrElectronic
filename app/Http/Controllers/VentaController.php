<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $venta = Venta::all();
        $cliente = Cliente::all();

        return view('Ventas.VentasIndex', compact('venta','cliente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto = Producto::all();
        $venta = Venta::all();
        $cliente = Cliente::all();

        return view('Ventas.VentasForm', compact('producto','venta','cliente'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validar datos básicos
        $request->validate([
            'cliente_id' => 'required',
            'fecha_venta' => 'required|date',
            'pago' => 'required|numeric|min:0',
            'productos' => 'required|array|min:1',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|numeric|min:1',
        ]);

        // 2. Crear nuevo cliente si se seleccionó "nuevo"
        if ($request->cliente_id === 'nuevo') {
            $request->validate([
                'nuevo_cliente_nombre' => 'required|string|max:255',
                'nuevo_cliente_documento' => 'required|string|max:50',
                'nuevo_cliente_telefono' => 'nullable|string|max:50',
                'nuevo_cliente_direccion' => 'nullable|string|max:255',
            ]);

            $cliente = Cliente::create([
                'nombre' => $request->nuevo_cliente_nombre,
                'documento' => $request->nuevo_cliente_documento,
                'telefono' => $request->nuevo_cliente_telefono,
                'direccion' => $request->nuevo_cliente_direccion,
            ]);
            $cliente_id = $cliente->id;
        } else {
            $cliente_id = $request->cliente_id;
        }

        // 3. Calcular total y cambio
        $total = 0;
        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);
            $subtotal = $producto->precio * $item['cantidad'];
            $total += $subtotal;
        }

        $pago = $request->pago;
        $cambio = max($pago - $total, 0); // Evita cambio negativo

        // 4. Crear la venta
        $venta = Venta::create([
            'cliente_id' => $cliente_id,
            'fecha_venta' => $request->fecha_venta,
            'total' => $total,
            'pago' => $pago,
            'cambio' => $cambio, // Guardamos el cambio calculado
        ]);

        // 5. Crear los detalles de venta y actualizar stock
        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['producto_id']);
            $subtotal = $producto->precio * $item['cantidad'];

            // Crear detalle
            $venta->detalles()->create([
                'producto_id' => $producto->id,
                'cantidad' => $item['cantidad'],
                'precio_unitario' => $producto->precio,
                'subtotal' => $subtotal,
            ]);

            // Actualizar stock
            $producto->cantidad -= $item['cantidad'];
            $producto->save();
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
    }



    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->load(['cliente', 'detalles.producto']); // Carga cliente y productos
        return view('Ventas.VentasShow', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
