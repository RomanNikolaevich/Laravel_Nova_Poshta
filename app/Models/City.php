<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = ['ref','description', 'description_ru', 'type', 'type_ru'];

    /**
     * Relationships
     *
     * @return HasMany
     */
    public function warehouses():HasMany
    {
        return $this->hasMany(Warehouse::class, 'city_ref');
    }
}
