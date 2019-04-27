<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retention extends Model
{
    protected $fillable = [
        'lot_number',
        'production_date',
        'expiration_date',
        'expiration_length',
        'box_id',
        'user_id',
        'product_id'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function inRetention($lot)
    {
        $retention = Retention::where('lot_number', $lot);
        if($retention)
        {
            return 'Lot already exists in system';
        }
    }
}
