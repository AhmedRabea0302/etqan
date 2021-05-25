<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotSuspicionComment extends Model
{
    public function commentReplies() {
        return $this->hasMany(HotSuspicionReply::class, 'comment_id', 'id');
    }
}
