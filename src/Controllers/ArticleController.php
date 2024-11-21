<?php

namespace AngusDV\ParsNews\Controllers;


use AngusDV\ParsNews\Entity\Article;
use AngusDV\ParsNews\Resources\API\V1\Article\ArticleCollection;
use Illuminate\Http\Request;

class ArticleController
{
    public function index(Request $request)
    {
        $articles=Article::query()->paginate(10);
        return (new ArticleCollection($articles))->toPaginate();
    }

    public function destroy()
    {
    }

    public function store()
    {
    }

    public function update()
    {
    }
    public function show()
    {
    }



}
