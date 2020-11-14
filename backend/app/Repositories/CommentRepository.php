<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends BaseRepository
{
    function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }

    /**
     * Add a comment
     *
     * @param $post_id
     * @param array $data
     * @return array
     */
    public function addComment($post_id, $data = [])
    {
        $comment = [
            'name' => $data['name'] ?? '',
            'comment' => $data['description'] ?? '',
            'post_id' => $post_id,
            'reply_id' => $data['reply_id'] ?? null
        ];

        $this->create($comment);

        return $comment;
    }

    /**
     * Get post comments
     *
     * @param $post_id
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function getPostComments($post_id, $limit = 3)
    {
        $postComment = Comment::with([
            'recentComments'
        ])->where('post_id', $post_id)
            ->orderBy('created_at', 'DESC')->get()
            ->map(function($comment) use ($limit) {
                $comment->setRelation('recentComments', $comment->recentComments->take($limit));
                return $comment;
            });

        return $postComment;
    }
}
