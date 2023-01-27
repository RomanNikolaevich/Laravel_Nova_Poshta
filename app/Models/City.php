<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = ['Description', 'DescriptionRu', 'SettlementTypeDescription', 'SettlementTypeDescriptionRu'];

    public function warehouses():HasMany
    {
        return $this->hasMany(Warehouse::class);
    }
}