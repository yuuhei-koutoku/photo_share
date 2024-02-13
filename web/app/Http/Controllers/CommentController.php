<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($id)
    {
        $comments = Comment::with('user')->where('photo_id', $id)->get();

        return response()->json($comments);
    }
}