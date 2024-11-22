<?php

namespace AngusDV\ParsNews\Requests\API\V1\Article;

use AngusDV\ParsNews\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'primary_image' => 'nullable|image|mimes:jpg,jpeg.png|min:10|max:2000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'required|file|min:10|max:2000',
        ];
    }
}
