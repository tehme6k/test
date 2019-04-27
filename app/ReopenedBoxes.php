<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Box;

class ReopenedBoxes extends Model
{
    protected $fillable = [
        'box_id',
        'reopen_date',
        'requested_by_id',
        'opened_by_id',
        'reason',
        'close_date',
        'closed_by'
    ];

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by_id');
    }


}
