<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    protected $fillable = ['ref','city_ref', 'description', 'description_ru'];

    /**
     *  Relationships
     *
     * @return BelongsTo
     */
    public function cities():BelongsTo
    {
        return $this->belongsTo(City::class, 'ref', 'city_ref');
    }
}
