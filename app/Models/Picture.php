<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Picture extends Model
{
    protected $fillable = [
        'path',
        'vehicle_id',
        'order',
        'alt_text'
    ];

    public function car(): BelongsTo{
        return $this->belongsTo(Car::class);
    }
}
