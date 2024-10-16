<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'peliculas'; // Nombre de la tabla en la base de datos

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'duracion',
        'fecha_estreno',
        'sinopsis',
        'director',
        'genero',
        'imagen_url',
    ];

    // Si tienes relaciones, puedes definirlas aquí
    // Ejemplo de relación 1:N con reviews (reseñas)
    /*public function reviews()
    {
        return $this->hasMany(Review::class);
    }*/
}
