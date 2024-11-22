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
    protected $fillable=[
        "title",
        "description",
    ];
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
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

    public function scopeSearch($query,$search)
    {
        return $query->where(function($query)use($search){
            $query->where('title','like','%'.$search.'%');
            $query->orWhere('description','like','%'.$search.'%');
        });
    }

    public function destroyAllAttachments()
    {
        foreach ( $this?->loadMedia('attachments')??[] as $media){
            $media->delete();
        }
        return $this;
    }
    public function setAttachment($files)
    {
        foreach ($files ?? [] as $file) {
            return $this->addMedia($file)->toMediaCollection('attachments');
        }
    }
    public function getAttachments()
    {
        $attachments=[];
        foreach ( $this?->loadMedia('attachments')??[] as $media){
            $attachments[]=$media->getUrl();
        }
        return $attachments;
    }


}
