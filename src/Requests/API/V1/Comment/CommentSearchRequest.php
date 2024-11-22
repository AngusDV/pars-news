<?php

namespace AngusDV\ParsNews\Requests\API\V1\Comment;

use AngusDV\ParsNews\Requests\BaseRequest;

class CommentSearchRequest extends BaseRequest
{
    public function rules()
    {
        return [
           'article_id'=>'nullable|string|exists:articles,id',
           'search'=>'nullable|string'
        ];
    }
}
