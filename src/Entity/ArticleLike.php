<?php

namespace AngusDV\ParsNews\Entity;

use Illuminate\Database\Eloquent\Model;

class ArticleLike extends Model
{
    protected $fillable = ['user_id', 'article_id', 'like_dislike'];

    public function user()
    {
        return $this->belongsTo(ApiUser::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}