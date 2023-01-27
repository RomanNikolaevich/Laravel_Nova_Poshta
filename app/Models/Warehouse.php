<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    protected $fillable = ['Description', 'DescriptionRu'];

    public function cities():BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
