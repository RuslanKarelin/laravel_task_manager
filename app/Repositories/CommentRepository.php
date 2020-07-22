<?php

namespace App\Repositories;

use \App\Interfaces\Repositories\ICommentRepository;
use App\Models\TaskManager\Comment;
use Illuminate\Http\Request;


class CommentRepository implements ICommentRepository
{
    /**
     * @return mixed
     */
    public function getLast($limit)
    {
        return Comment::orderBy('id', 'desc')->limit($limit)->get();
    }
}