<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $table = 'series'; // Nombre de la tabla en la base de datos

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_serie',
        'sinopsis',
        'temporadas',
        'imagen_portada',
        'genero',
        'creador'
    ];

    // Definir relaciones si es necesario
    // Ejemplo de relación 1:N con episodios
    /*public function episodes()
    {
        return $this->hasMany(Episode::class);
    }*/
}
