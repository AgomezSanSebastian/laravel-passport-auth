<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get the Restaurant that owns the food
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }
}
