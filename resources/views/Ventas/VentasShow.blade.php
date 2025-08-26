@extends('welcome')
@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg border border-gray-200">
    <!-- Encabezado -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-blue-800">Factura #{{ $venta->id }}</h1>
        <span class="text-black">{{ $venta->fecha_venta->format('d-m-Y') }}</span>
    </div>

    <!-- Datos del Cliente -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-blue-600 border-b-2 border-gray-300 pb-2 mb-4">Datos del cliente</h2>
        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-sm font-semibold text-gray-600">Nombre</th>
                        <th class="text-sm font-semibold text-gray-600">Documento</th>
                        <th class="text-sm font-semibold text-gray-600">Teléfono</th>
                        <th class="text-sm font-semibold text-gray-600">Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $venta->cliente->nombre }}</td>
                        <td>{{ $venta->cliente->documento }}</td>
                        <td>{{ $venta->cliente->telefono }}</td>
                        <td>{{ $venta->cliente->direccion }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Productos -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-blue-600 border-b-2 border-gray-300 pb-2 mb-4">Datos del producto</h2>
        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-sm font-semibold text-gray-600">Producto</th>
                        <th class="text-sm font-semibold text-gray-600">Cantidad</th>
                        <th class="text-sm font-semibold text-gray-600">Precio Unitario</th>
                        <th class="text-sm font-semibold text-gray-600">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $detalle)
                        <tr>
                            <td class="text-sm font-semibold text-gray-600">{{ $detalle->producto->tipo->nombre }} - {{ $detalle->producto->marca->nombre }} - {{ $detalle->producto->modelo->nombre }}</td>
                            <td class="text-sm font-semibold text-gray-600">{{ $detalle->cantidad }}</td>
                            <td class="text-sm font-semibold text-gray-600">${{ number_format($detalle->precio_unitario,0, 2) }}</td>
                            <td class="text-sm font-semibold text-gray-600">${{ number_format($detalle->subtotal,0, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Totales -->


    <div class="flex flex-col md:flex-row justify-end md:space-x-12 text-gray-800 text-lg font-semibold">
        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-sm font-semibold text-gray-600">Total </th>
                        <th class="text-sm font-semibold text-gray-600">Pago</th>
                        <th class="text-sm font-semibold text-gray-600">Cambio</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-sm font-semibold text-green-600">${{ number_format($venta->total,0,2) }}</td>
                        <td class="text-sm font-semibold text-gray-600">${{ number_format($venta->pago,0,2) }}</td>
                        <td class="text-sm font-semibold text-blue-600">${{ number_format($venta->cambio,0,2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botón -->
    <div class="mt-8 flex justify-center">
        <a href="{{ route('ventas.index') }}" class="btn btn-outline btn-warning "><- Volver al listado</a>
    </div>
</div>

@endsection
