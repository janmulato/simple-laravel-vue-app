<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'comment', 'reply_id'];

    /**
     * Parent comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Comment', 'reply_id', 'id');
    }

    /**
     * Define the relation with replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany('App\Models\Comment', 'reply_id', 'id');
    }

    /**
     * Get recent comments limit to only 3
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recentComments()
    {
        return $this->replies()->with(['recentComments' => function($query) {
            $query->take(3);
        }])->latest();
    }

    // Get comments by post id

}
