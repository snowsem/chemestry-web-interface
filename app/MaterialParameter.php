<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaterialParameter extends Model
{
    protected $table = 'material_parameter';

    public function materials(){
        return $this->belongsToMany(Material::class);

    }
    public function parameters(){
        return $this->belongsToMany(Parameter::class);

    }
}
