<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhorroVisual extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo (opcional si el nombre sigue la convención de Laravel)
    protected $table = 'ahorro_visual';

    // Especificar los campos que se pueden asignar en masa
    protected $fillable = ['ejemplo', 'ahorro', 'foto'];
}
