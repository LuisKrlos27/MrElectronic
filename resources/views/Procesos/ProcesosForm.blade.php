@extends('welcome')
@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
    <h2 class="text-2xl text-center font-bold mb-8 text-primary">REGISTRO DE PROCESOS</h2>

    <form action="{{ route('procesos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        <!-- Cliente -->
        <div class="md:col-span-2">
            <label class="text-sm font-semibold text-gray-600">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="select select-bordered w-full" required>
                <option value="">Selecciona un cliente</option>
                @foreach($clientes as $cli)
                    <option value="{{ $cli->id }}">{{ $cli->nombre }}</option>
                @endforeach
                <option value="nuevo">+ Agregar nuevo cliente</option>
            </select>
        </div>
        <!-- Campos para nuevo cliente -->
        <div id="nuevo_cliente_fields" class="md:col-span-2 hidden grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
            <div>
                <label class="text-sm font-semibold text-gray-600">Nombre</label>
                <input type="text" name="nuevo_cliente_nombre" class="input input-bordered w-full" placeholder="Nombre completo">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Documento</label>
                <input type="text" name="nuevo_cliente_documento" class="input input-bordered w-full" placeholder="DNI, Cédula, etc.">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Teléfono</label>
                <input type="text" name="nuevo_cliente_telefono" class="input input-bordered w-full" placeholder="Ej: +58 424-1234567">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-600">Dirección</label>
                <input type="text" name="nuevo_cliente_direccion" class="input input-bordered w-full" placeholder="Dirección completa">
            </div>
        </div>
        
        <!-- Marca -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Marca</label>
            <input type="text" name="marca" class="input input-bordered w-full"
                value="{{ old('marca') }}" placeholder="Ejemplo: Samsung, LG, Sony" required>
        </div>

        <!-- Modelo -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Modelo</label>
            <input type="text" name="modelo" class="input input-bordered w-full"
                value="{{ old('modelo') }}" placeholder="Ejemplo: QN90C, CX, Crystal UHD" required>
        </div>

        <!-- Pulgadas -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Pulgadas</label>
            <input type="number" name="pulgadas" class="input input-bordered w-full"
                value="{{ old('pulgadas') }}" placeholder="Ejemplo: 55" required>
        </div>

        <!-- Descripción de Falla -->
        <div class="md:col-span-2">
            <label class="text-sm font-semibold text-gray-600">Descripción de la Falla</label>
            <textarea name="descripcion_falla" class="textarea textarea-bordered w-full"
                placeholder="Ejemplo: No enciende, líneas horizontales, sonido sin imagen..." required>{{ old('descripcion_falla') }}</textarea>
        </div>

        <!-- Fecha Inicio -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="input input-bordered w-full"
                value="{{ old('fecha_inicio', now()->format('Y-m-d')) }}" required>
        </div>

        <!-- Estado -->
        <div>
            <label class="text-sm font-semibold text-gray-600">Estado</label>
            <select name="estado" class="select select-bordered w-full" required>
                <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>Abierto</option>
                <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>Cerrado</option>
            </select>
        </div>

        <!-- Botones -->
        <div class="md:col-span-2 flex justify-center gap-4 pt-4">
            <a href="{{ route('procesos.index') }}" class="btn btn-warning">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>

<script>
    // Mostrar/ocultar campos de nuevo cliente
    function toggleNuevoCliente(select) {
        const fields = document.getElementById('nuevo_cliente_fields');
        fields.classList.toggle('hidden', select.value !== 'nuevo');
    }
</script>

@endsection
