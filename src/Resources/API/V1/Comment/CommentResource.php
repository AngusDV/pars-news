<?php

namespace AngusDV\ParsNews\Resources\API\V1\Comment;

use AngusDV\ParsNews\Resources\BaseResource;

class CommentResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'article_id' => $this?->article_id??"",
            'comment' => $this?->comment??"",
            'totalLikes' => (int)$this?->total_likes??0,
            'totalDislikes' => (int)$this?->total_dislikes??0
        ];
    }

}
