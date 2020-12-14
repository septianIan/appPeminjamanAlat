<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getToolNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function arragement()
    {
        return $this->hasOne(ToolArragement::class);
    }
}
