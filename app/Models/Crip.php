<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crip extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function criteria()
    {
        return $this->belongsTo(Criteria::class);
    }

}
