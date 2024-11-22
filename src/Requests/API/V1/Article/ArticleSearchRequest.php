<?php

namespace AngusDV\ParsNews\Requests\API\V1\Article;

use AngusDV\ParsNews\Requests\BaseRequest;

class ArticleSearchRequest extends BaseRequest
{
    public function rules()
    {
        return [
           'search'=>'nullable|string'
        ];
    }
}
