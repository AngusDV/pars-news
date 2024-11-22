<?php

namespace AngusDV\ParsNews\Requests\API\V1\Comment;

use AngusDV\ParsNews\Requests\BaseRequest;

class CommentStoreRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'article_id' => 'required|integer|exists:articles,id',
            'user_id' => 'required|exists:api_users,id',
            'comment' => 'required|string|max:500|min:1',
        ];
    }
}
