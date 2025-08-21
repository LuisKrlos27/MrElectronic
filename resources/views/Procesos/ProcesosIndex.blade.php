{{-- resources/views/procesos/index.blade.php --}}
@extends('welcome')

@section('content')
<div class="max-w-6xl mx-auto mt-10 bg-base-100 p-8 rounded-lg shadow-lg">
    <h2 class="text-3xl font-bold text-center text-primary mb-8">LISTADO DE PROCESOS</h2>

    <div class="flex justify-end mb-4">
        <a href="{{ route('procesos.create') }}" class="font-bold btn btn-outline btn-success">REGISTRAR</a>
    </div>

    @if($procesos->isEmpty())
        <p class="text-center text-gray-600">No hay procesos registrados.</p>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($procesos as $proceso)
                    <tr>
                        <td>{{ $proceso->id }}</td>
                        <td>{{ $proceso->nombre }}</td>
                        <td>{{ $proceso->descripcion }}</td>
                        <td>{{ $proceso->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('procesos.show', $proceso) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('procesos.edit', $proceso) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('procesos.destroy', $proceso) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar este proceso?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay procesos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif
</div>
@endsection
