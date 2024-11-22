<?php

namespace AngusDV\ParsNews\Controllers;


use AngusDV\ParsNews\Entity\Article;
use AngusDV\ParsNews\Requests\API\V1\Article\ArticleSearchRequest;
use AngusDV\ParsNews\Requests\API\V1\Article\ArticleUpdateRequest;
use AngusDV\ParsNews\Requests\API\V1\Article\ArticleStoreRequest;
use AngusDV\ParsNews\Resources\API\V1\Article\ArticleCollection;
use AngusDV\ParsNews\Resources\API\V1\Article\ArticleResource;
use AngusDV\ParsNews\Resources\BaseResource;
use Illuminate\Support\Facades\DB;

class ArticleController
{
    public function index(ArticleSearchRequest $request)
    {
        $articles = Article::query();
        if ($request->filled('search')) {
            $articles->search($request->search);
        }
        $articles = $articles->paginate(10);
        return (new ArticleCollection($articles))->toPaginate();
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return BaseResource::trueResponse();
    }

    public function store(ArticleStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $article = new Article($request->only(['title', 'description']));
            $article->user_id = auth('sanctum')->user()->id;
            $article->creator_id = auth('sanctum')->user()->id;
            $article->save();
            if ($request->hasFile('primary_image')) {
                $article->setFile($request->file('primary_image'), 'primary_image');
            }
            if ($request->has('attachments')) {
                $article->setAttachment($request->attachments);
            }
            DB::commit();
            return BaseResource::trueResponse();
        } catch (\Exception $e) {
            DB::rollBack();
            return BaseResource::falseResponse($e->getMessage());
        }
    }

    public function update(ArticleUpdateRequest $request, Article $article)
    {
        DB::beginTransaction();
        try {
            $article->fill($request->only(['title', 'description']))->save();
            if ($request->hasFile('primary_image')) {
                $article->setFile($request->file('primary_image'), 'primary_image');
            }
            if ($request->has('attachments')) {
                $article->destroyAllAttachments()->setAttachment($request->attachments);
            }
            DB::commit();
            return BaseResource::trueResponse();
        } catch (\Exception $e) {
            DB::rollBack();
            return BaseResource::falseResponse($e->getMessage());
        }
    }

    public function show(Article $article)
    {
        return (new ArticleResource($article));
    }


}
