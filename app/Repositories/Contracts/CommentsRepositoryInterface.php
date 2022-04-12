<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;
use App\Models\User;

interface CommentsRepositoryInterface
{
    public function create(array $requestData, User $user): Comment;
    public function update(array $requestData, Comment $comment): bool;
}
