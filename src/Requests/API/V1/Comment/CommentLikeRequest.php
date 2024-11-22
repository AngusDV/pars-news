<?php

namespace AngusDV\ParsNews\Requests\API\V1\Comment;

use AngusDV\ParsNews\Requests\BaseRequest;

class CommentLikeRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'type' => 'required|in:like,dislike'
        ];
    }
}
