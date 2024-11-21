<?php

namespace AngusDV\ParsNews\Resources\API\V1;

use AngusDV\ParsNews\Resources\BaseResource;

class ApiUserResource extends BaseResource
{
    public $token;

    public function __construct($resource, $token = null)
    {
        $this->token = $token;
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this?->name??"",
            'email' => $this->email,
            $this->mergeWhen(!is_null($this->token), [
                'accessToken' => $this->token
            ])
        ];
    }

}
