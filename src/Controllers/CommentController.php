<?php

namespace AngusDV\ParsNews\Controllers;


use AngusDV\ParsNews\Entity\Comment;
use AngusDV\ParsNews\Requests\API\V1\Comment\CommentLikeRequest;
use AngusDV\ParsNews\Requests\API\V1\Comment\CommentSearchRequest;
use AngusDV\ParsNews\Requests\API\V1\Comment\CommentStoreRequest;
use AngusDV\ParsNews\Requests\API\V1\Comment\CommentUpdateRequest;
use AngusDV\ParsNews\Resources\API\V1\Comment\CommentCollection;
use AngusDV\ParsNews\Resources\API\V1\Comment\CommentResource;
use AngusDV\ParsNews\Resources\BaseResource;


class CommentController
{
    public function index(CommentSearchRequest $request)
    {
        $comments = Comment::query();
        if ($request->filled('search')) {
            $comments->search($request->search);
        }
        if ($request->filled('article_id')) {
            $comments->whereArticleId($request->article_id);
        }
        $comments = $comments
            ->withLikesCount()
            ->withDislikesCount()
            ->paginate(10);
        return (new CommentCollection($comments))->toPaginate();
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return BaseResource::trueResponse();
    }

    public function store(CommentStoreRequest $request)
    {
        $comment = new Comment($request->only(['comment', 'user_id', 'article_id']));
        $comment->save();
        return BaseResource::trueResponse();
    }

    public function update(CommentUpdateRequest $request,Comment $comment)
    {
        $comment->update($request->only(['comment']));
        return BaseResource::trueResponse();
    }

    public function show(Comment $comment)
    {
        return (new CommentResource($comment->withLikesCount()->withDislikesCount()->first()));
    }

    public function likeOrDislike(CommentLikeRequest $request,Comment $comment)
    {
        $request->merge([
            "user_id"=>auth('sanctum')->user()->id,
            "comment_id"=>$comment->id
        ]);
        $comment->commentLikes()->create($request->only(["user_id","comment_id","type"]));
        return (new CommentResource($comment->withLikesCount()->withDislikesCount()->first()));
    }

}
