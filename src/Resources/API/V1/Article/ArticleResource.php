<?php

namespace AngusDV\ParsNews\Resources\API\V1\Article;

use AngusDV\ParsNews\Resources\BaseResource;

class ArticleResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this?->title??"",
            'description' => $this?->description??"",
            'primaryImage' => $this?->getFile("primary_image")?->getUrl()??'',
        ];
    }

}
