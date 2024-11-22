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
    public function commentLikes(): HasMany
    {
        return $this->hasMany(CommentLike::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function scopeSearch($query,$search)
    {
        return $query->where(function($query)use($search){
            $query->where('comment','like','%'.$search.'%');
        });
    }

    // Scope for counting likes
    public function scopeWithLikesCount($query)
    {
        return $query->withCount(['commentLikes as total_likes' => function ($query) {
            $query->where('type', 'like');
        }]);
    }

    // Scope for counting dislikes
    public function scopeWithDislikesCount($query)
    {
        return $query->withCount(['commentLikes as total_dislikes' => function ($query) {
            $query->where('type', 'dislike');
        }]);
    }

}
