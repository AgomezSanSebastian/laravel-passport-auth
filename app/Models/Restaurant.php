<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'street'
    ];

    /**
     * Get all of the foods for the restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    /**
     * Get the user that owns the restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
