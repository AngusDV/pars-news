<?php

namespace AngusDV\ParsNews\Entity;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $fillable = ['user_id', 'article_id', 'like_dislike'];

    public function user()
    {
        return $this->belongsTo(ApiUser::class,'user_id');
    }
    public function creator()
    {
        return $this->belongsTo(ApiUser::class,'creator_id');
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
