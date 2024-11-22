<?php

namespace AngusDV\ParsNews\Requests\API\V1\Comment;

use AngusDV\ParsNews\Requests\BaseRequest;

class CommentUpdateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'comment' => 'required|string'
        ];
    }
}
