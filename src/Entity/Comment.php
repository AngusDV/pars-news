<?php

namespace AngusDV\ParsNews\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = ['user_id', 'article_id', 'comment'];

    public function user()
    {
        return $this->belongsTo(ApiUser::class,'user_id');
    }
    public function creator()
    {
        return $this->belongsTo(ApiUser::class,'creator_id');
    }
    public function likes(): HasMany
    {
        return $this->hasMany(CommentLike::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
