<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'parent_id', 'id');
    }
    
    public function childrenDiscussions()
    {
        return $this->hasMany(Discussion::class, 'parent_id', 'id')->with('childrenDiscussions');
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }
}
