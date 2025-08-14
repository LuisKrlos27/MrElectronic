<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'marca_id', 'modelo_id', 'precio', 'cantidad',
        'numero_pieza', 'descripcion'
    ];

    protected $casts = [
        'precio'   => 'decimal:2',
        'cantidad' => 'integer',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'modelo_id');
    }

    public function procesos()
    {
        return $this->hasMany(Proceso::class, 'producto_id');
    }

    // Relación many-to-many con ventas vía detalle_ventas
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'detalle_ventas', 'producto_id', 'venta_id')
            ->withPivot(['cantidad', 'precio_unitario', 'subtotal']);
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'producto_id');
    }
}
