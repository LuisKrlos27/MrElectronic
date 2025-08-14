<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'procesos';

    protected $fillable = [
        'producto_id', 'descripcion', 'estado',
        'fecha_inicio', 'fecha_cierre'
    ];

    protected $casts = [
        'estado'       => 'boolean',
        'fecha_inicio' => 'datetime',
        'fecha_cierre' => 'datetime',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class, 'proceso_id');
    }
}
