<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    public function evidences()
    {
        return $this->hasMany(Evidence::class, 'parent_id', 'id');
    }
    
    public function childrenEvidences()
    {
        return $this->hasMany(Evidence::class, 'parent_id', 'id')->with('childrenEvidences');
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
