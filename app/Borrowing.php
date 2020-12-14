<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    protected $guarded = [];

    public function toolArragements()
    {
        return $this->belongsToMany(ToolArragement::class, 'tool_borrowing');
    }

    public function details()
    {
        return $this->hasMany(DetailBorrowing::class);
    }

    public function getFormatTgl()
    {
        return Carbon::parse($this->date)->formatLocalized('%A %d %B %Y');
    }
}
