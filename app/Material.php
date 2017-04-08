<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public function parameters() {
        return $this->belongsToMany(Parameter::class)->withPivot('value');
    }
}
