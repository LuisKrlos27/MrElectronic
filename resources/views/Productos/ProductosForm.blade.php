@extends('welcome')
@section('content')

<div class="max-w-2xl mx-auto mt-10 bg-base-100 p-6 rounded shadow">
    <h2 class="text-2xl text-center font-bold mb-8 text-primary">REGISTRO DE PRODUCTOS</h2>

    <form action="{{ route('productos.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf

        {{-- Tipo --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">Tipo</label>
            <select name="tipo_id" id="tipo_id" class="select select-bordered w-full" onchange="toggleNuevoTipo(this)">
                <option value="">-- Selecciona un tipo --</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
                <option value="nuevo_tipo">+ Agregar nuevo tipo</option>
            </select>
            <input type="text" name="nuevo_tipo" id="nuevo_tipo" class="input input-bordered w-full mt-2 hidden" placeholder="Escribe el nuevo tipo">
        </div>

        {{-- Pulgadas --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">Pulgadas</label>
            <select name="pulgada_id" id="pulgada_id" class="select select-bordered w-full" onchange="toggleNuevaPulgada(this)">
                <option value="">-- Selecciona pulgadas --</option>
                @foreach($pulgadas as $pulgada)
                    <option value="{{ $pulgada->id }}">{{ $pulgada->valor }}</option>
                @endforeach
                <option value="nueva_pulgada">+ Agregar nuevas pulgadas</option>
            </select>
            <input type="text" name="nueva_pulgada" id="nueva_pulgada" class="input input-bordered w-full mt-2 hidden" placeholder="Ej: 42">
        </div>

        {{-- Marca --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">Marca</label>
            <select name="marca_id" id="marca_id" class="select select-bordered w-full" onchange="toggleNuevaMarca(this)">
                <option value="">-- Selecciona una marca --</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                @endforeach
                <option value="nueva">+ Agregar nueva marca</option>
            </select>
            <input type="text" name="nueva_marca" id="nueva_marca" class="input input-bordered w-full mt-2 hidden" placeholder="Escribe la nueva marca">
        </div>

        {{-- Modelo --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">Modelo</label>
            <select name="modelo_id" id="modelo_id" class="select select-bordered w-full" onchange="toggleNuevoModelo(this)">
                <option value="">-- Selecciona un modelo --</option>
                @foreach($modelos as $modelo)
                    <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                @endforeach
                <option value="nuevo">+ Agregar nuevo modelo</option>
            </select>
            <input type="text" name="nuevo_modelo" id="nuevo_modelo" class="input input-bordered w-full mt-2 hidden" placeholder="Escribe el nuevo modelo">
        </div>

        {{-- Precio --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">Precio</label>
            <input type="number" step="0.01" name="precio" class="input input-bordered w-full" value="{{ old('precio') }}" required>
            @error('precio')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- Cantidad --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">Cantidad</label>
            <input type="number" name="cantidad" class="input input-bordered w-full" value="{{ old('cantidad') }}" required>
            @error('cantidad')
                <span class="text-red-500 text-xs">{{ $message }}</span>
            @enderror
        </div>

        {{-- N° de pieza --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">N° de pieza</label>
            <input type="text" name="numero_pieza" class="input input-bordered w-full" value="{{ old('numero_pieza') }}">
        </div>

        {{-- Descripción --}}
        <div>
            <label class="text-sm font-semibold text-gray-600">Descripción</label>
            <textarea name="descripcion" class="textarea font-semibold text-gray-600 w-full" placeholder="Descripción">{{ old('descripcion') }}</textarea>
        </div>

        {{-- Botones --}}
        <div class="md:col-span-2 flex justify-center gap-4 pt-4">
            <a href="{{ route('productos.index') }}" class="btn btn-warning">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>

<script>
    function toggleNuevoTipo(select) {
        document.getElementById('nuevo_tipo').classList.toggle('hidden', select.value !== 'nuevo_tipo');
    }
    function toggleNuevaPulgada(select) {
        document.getElementById('nueva_pulgada').classList.toggle('hidden', select.value !== 'nueva_pulgada');
    }
    function toggleNuevaMarca(select) {
        document.getElementById('nueva_marca').classList.toggle('hidden', select.value !== 'nueva');
    }
    function toggleNuevoModelo(select) {
        document.getElementById('nuevo_modelo').classList.toggle('hidden', select.value !== 'nuevo');
    }
</script>

@endsection
