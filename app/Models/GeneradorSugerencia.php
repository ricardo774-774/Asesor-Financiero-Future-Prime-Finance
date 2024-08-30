<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneradorSugerencia extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar en masa.
     *
     * @var array
     */
    protected $fillable = [
        'sugerencia_cid',
        'titulo',
        'monto',
    ];

    /**
     * Relación con el modelo GeneradorCategoria.
     * Una sugerencia pertenece a una categoría.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(GeneradorCategoria::class, 'sugerencia_cid');
    }
}
