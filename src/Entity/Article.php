<?php

namespace AngusDV\ParsNews\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia,SoftDeletes;
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(ArticleLike::class);
    }
    public function setFile($file, $collection_name)
    {
        !$this?->getFile($collection_name) ?: $this?->getFile($collection_name)?->delete();
        return $this->addMedia($file)->toMediaCollection($collection_name);
    }
    public function getFile($collection_name)
    {
        return $this?->getFirstMedia($collection_name);
    }



}
