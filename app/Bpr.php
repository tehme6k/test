<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bpr extends Model
{
    protected $fillable = [
        'mpr_id',
        'lot_number',
        'bottle_count',
        'created_by',
        'approved_by',
        'status',
        'project_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }

    public function mpr()
    {
        return $this->belongsTo(Mpr::class);
    }
}
