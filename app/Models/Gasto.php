<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Gasto extends Model
{

    use HasFactory;
    protected $appends = ['percentage'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(): HasOne
    {
        return $this->hasOne(categoriasg::class,"id","categoriasID");
    }
    public function getPercentageAttribute(): float
    {
        // Calculate the user's total expenses
        $totalExpenses = Gasto::where('userID',$this->userID)->sum('monto'); // Replace 'amount' with your actual field name

        // Avoid division by zero
        if ($totalExpenses == 0) {
            return 0;
        }

        // Calculate and return the percentage
        return ($this->monto / $totalExpenses) * 100; // Replace 'amount' with your actual field name
    }
}
