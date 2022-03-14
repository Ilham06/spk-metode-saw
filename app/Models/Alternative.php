<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function criteria()
    {
        return $this->belongsToMany(Criteria::class)->withPivot(['criteria_id','value', 'normalize'])->withTimeStamps();
    }
}
