<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suspicion extends Model
{

    public function suspicions()
    {
        return $this->hasMany(Suspicion::class, 'parent_id', 'id');
    }
    
    public function childrenSuspicions()
    {
        return $this->hasMany(Suspicion::class, 'parent_id', 'id')->with('childrenSuspicions');
    }

    public function childs()
    {
        return $this->hasMany($this, 'parent_id');
    }
    

    // public function childs()
    // {   
    //     if($this->hasMany(Suspicion::class, 'parent_id', 'id')) {
    //         return $this->hasMany(Suspicion::class, 'parent_id', 'id');
    //     } else {
    //         return $this->reply;
    //     }
        
    //     childs();
    // }

}
