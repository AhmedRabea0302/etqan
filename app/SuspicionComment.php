<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuspicionComment extends Model
{
    public function commentReplies() {
        return $this->hasMany(SuspicionReply::class, 'comment_id', 'id');
    }
}
