<?php

namespace App\Http\Controllers;

use App\Repositories\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    /**
     * @var CommentRepository
     */
    protected $repository;

    /**
     * Comment constructor.
     * @param CommentRepository $commentRepository
     */
    public function __construct(CommentRepository $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    /**
     * @param $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index($post_id)
    {
        $comments = $this->repository->getPostComments($post_id);

        return response($comments);
    }

    /**
     * @param Request $request
     * @param $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function addComment(Request $request, $post_id)
    {
        $comment = $this->repository->addComment($post_id, $request);

        return response($comment);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     */
    public function addReply(Request $request, $id)
    {
        $comment = $this->repository->addComment($id, $request);

        return $comment;
    }
}
