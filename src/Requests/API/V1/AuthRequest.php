<?php

namespace AngusDV\ParsNews\Requests\API\V1;

use AngusDV\ParsNews\Requests\BaseRequest;

class AuthRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'email'=>"required|string|email|exists:api_users,email",
            'password'=>"required|string"
        ];
    }
}
