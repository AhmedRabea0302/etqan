<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscussionComment extends Model
{
    public function commentReplies() {
        return $this->hasMany(DiscussionReply::class, 'comment_id', 'id');
    }
}
