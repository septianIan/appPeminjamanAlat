<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToolArragement extends Model
{
    protected $guarded = [];

    public function tool()
    {
        return $this->belongsTo(Tool::class);
    }

    public function borrowing()
    {
        return $this->belongsToMany(Borrowing::class, 'tool_borrowing');
    }
}
