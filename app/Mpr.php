<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpr extends Model
{
    protected $fillable = [
        'project_id',
        'version',
        'created_by',
        'approved_by',
        'status',
        'serving_size',
        'type_id',
        'gpb'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }

}
