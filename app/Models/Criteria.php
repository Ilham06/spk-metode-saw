<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function crips()
    {
        return $this->hasMany(Crip::class);
    }

    public function alternative()
    {
        return $this->belongsToMany(Alternative::class);
    }

    public function criteriaNormalize()
    {
        $data = Criteria::sum('weight');

        return $this->weight/$data;
    }
}
