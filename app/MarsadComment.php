<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarsadComment extends Model
{
    public function commentReplies() {
        return $this->hasMany(MarsadReply::class, 'comment_id', 'id');
    }
}
