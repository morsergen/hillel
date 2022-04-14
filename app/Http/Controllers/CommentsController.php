<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\ReplyCommentRequest;
use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Requests\Comments\UpdateCommentRequest;
use App\Models\Comment;
use App\Repositories\Contracts\CommentsRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class CommentsController extends Controller
{
    /**
     * @param StoreCommentRequest $storeCommentRequest
     * @param CommentsRepositoryInterface $commentsRepository
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $storeCommentRequest, CommentsRepositoryInterface $commentsRepository): RedirectResponse
    {
        $commentsRepository->create($storeCommentRequest->validated(), $storeCommentRequest->user());
        return redirect()->back();
    }

    /**
     * @param ReplyCommentRequest $replyCommentRequest
     * @param CommentsRepositoryInterface $commentsRepository
     * @return RedirectResponse
     */
    public function reply(ReplyCommentRequest $replyCommentRequest, CommentsRepositoryInterface $commentsRepository): RedirectResponse
    {
        $commentsRepository->create($replyCommentRequest->validated(), $replyCommentRequest->user());
        return redirect()->back();
    }

    /**
     * @param UpdateCommentRequest $updateCommentRequest
     * @param CommentsRepositoryInterface $commentsRepository
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function update(UpdateCommentRequest $updateCommentRequest, CommentsRepositoryInterface $commentsRepository, Comment $comment): RedirectResponse
    {
        $commentsRepository->update($updateCommentRequest->validated(), $comment);
        return redirect()->back();
    }
}
