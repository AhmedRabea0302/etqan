<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvidenceComment extends Model
{
    public function commentReplies() {
        return $this->hasMany(EvidenceReply::class, 'comment_id', 'id');
    }
}
