<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    // Establecemos la tabla asociada al modelo. No sería necesario al seguir la convención
   protected $table = 'restaurants';

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

    

}
