@extends('welcome')
@section('content')

<div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-lg border border-gray-200">
    <!-- Encabezado -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Factura #{{ $venta->id }}</h1>
        <span class="text-gray-500">{{ $venta->fecha_venta->format('d-m-Y') }}</span>
    </div>

    <!-- Datos del Cliente -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-gray-300 pb-2 mb-4">Cliente</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-800">
            <p><strong>Nombre:</strong> {{ $venta->cliente->nombre }}</p>
            <p><strong>Documento:</strong> {{ $venta->cliente->documento }}</p>
            <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono ?? 'N/A' }}</p>
            <p><strong>Dirección:</strong> {{ $venta->cliente->direccion ?? 'N/A' }}</p>
        </div>
    </div>

    <!-- Productos -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-800 border-b-2 border-gray-300 pb-2 mb-4">Productos</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 border-b text-left text-gray-900">Producto</th>
                        <th class="px-4 py-2 border-b text-center text-gray-900">Cantidad</th>
                        <th class="px-4 py-2 border-b text-right text-gray-900">Precio Unitario</th>
                        <th class="px-4 py-2 border-b text-right text-gray-900">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalles as $detalle)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b text-gray-800">{{ $detalle->producto->tipo->nombre }} - {{ $detalle->producto->marca->nombre }} - {{ $detalle->producto->modelo->nombre }}</td>
                            <td class="px-4 py-2 border-b text-center text-gray-800">{{ $detalle->cantidad }}</td>
                            <td class="px-4 py-2 border-b text-right text-gray-800">${{ number_format($detalle->precio_unitario,0, 2) }}</td>
                            <td class="px-4 py-2 border-b text-right text-gray-800">${{ number_format($detalle->subtotal,0, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Totales -->
    <div class="flex flex-col md:flex-row justify-end md:space-x-12 text-gray-800 text-lg font-semibold">
        <div class="space-y-1 text-right">
            <p>Total: <span class="text-green-600">${{ number_format($venta->total,0, 2) }}</span></p>
            <p>Pago: <span class="text-blue-600">${{ number_format($venta->pago,0, 2) }}</span></p>
            <p>Cambio: <span class="text-purple-600">${{ number_format($venta->cambio,0, 2) }}</span></p>
        </div>
    </div>

    <!-- Botón -->
    <div class="mt-8 flex justify-center">
        <a href="{{ route('ventas.index') }}" class="px-6 py-2 bg-yellow-500 text-white font-semibold rounded-lg shadow hover:bg-yellow-600 transition">Volver a ventas</a>
    </div>
</div>

@endsection
