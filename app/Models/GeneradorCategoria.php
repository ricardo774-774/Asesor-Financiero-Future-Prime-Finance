<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneradorCategoria extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'tiempo_meta',
    ];

    /**
     * Relación con el modelo GeneradorSugerencia.
     * Una categoría puede tener muchas sugerencias.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sugerencias()
    {
        return $this->hasMany(GeneradorSugerencia::class, 'sugerencia_cid');
    }
}
