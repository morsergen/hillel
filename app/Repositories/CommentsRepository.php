<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\User;
use App\Repositories\Contracts\CommentsRepositoryInterface;

class CommentsRepository implements CommentsRepositoryInterface
{
    public function create(array $requestData, User $user): Comment
    {
        $model = $requestData['model_class'];

        if (!class_exists($model)) {
            throw new \Exception($model . ' class doesn\'t exists');
        }

        $comment = new Comment();
        $comment->body = $requestData['body'];
        $comment->user()->associate($user);

        if (isset($requestData['parent_id'])) {
            $comment->parent_id = $requestData['parent_id'];
        }

        $model = new $model();
        $model = $model->find($requestData['model_id']);
        $model->comments()->save($comment);

        return $comment;
    }

    public function update(array $requestData, Comment $comment): bool
    {
        return $comment->update(['body' => $requestData['body']]);
    }
}
