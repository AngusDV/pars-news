<?php

namespace AngusDV\ParsNews\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class BaseCollection extends ResourceCollection
{
    public function __construct($resource)
    {
        self::withoutWrapping();
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'isSuccess' => true,
            'code' => 200,
            'result' => $this->collection,
            'message' => "",
        ];
    }

    public function toPaginate(){
        return [
            'isSuccess' => true,
            'code' => 200,
            'result' => $this->collection,
            'currentPage' => $this->currentPage(),
            'totalPage' =>  ceil($this->total() / $this->perPage()) ,
            'perPage' => $this->perPage(),
            'message' => "",
        ];
    }

}
