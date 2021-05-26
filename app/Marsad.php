<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marsad extends Model
{
    public function marsads()
    {
        return $this->hasMany(Marsad::class, 'parent_id', 'id');
    }
    
    public function childrenMarsads()
    {
        return $this->hasMany(Marsad::class, 'parent_id', 'id')->with('childrenMarsads');
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
