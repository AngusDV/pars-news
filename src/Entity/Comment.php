<?php

namespace AngusDV\ParsNews\Entity;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'article_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(ApiUser::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
