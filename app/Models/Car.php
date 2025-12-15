<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    protected $fillable = [
        'brand_id',
        'horse_power',
        'made_in',
        'newton_meter',
        'type',
        'fuel',
        'door_num',
        'ccm',
        'price',
        'description'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function pictures(): HasMany{
        return $this->hasMany(Picture::class,'car_id');
    }

    public function brand(): BelongsTo{
        return $this->belongsTo(Brand::class);
    }
}
