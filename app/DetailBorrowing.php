<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailBorrowing extends Model
{
    protected $guarded = [];

    public function borrowing()
    {
        return $this->belongsToMany(Borrowing::class);
    }
}
