<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotSuspicion extends Model
{
    public function suspicions()
    {
        return $this->hasMany(HotSuspicion::class, 'parent_id', 'id');
    }
    
    public function childrenSuspicions()
    {
        return $this->hasMany(HotSuspicion::class, 'parent_id', 'id')->with('childrenSuspicions');
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
