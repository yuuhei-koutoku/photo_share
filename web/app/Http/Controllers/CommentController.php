<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Photo;

class CommentController extends Controller
{
    public function index($id)
    {
        $comments = Comment::with('user')->where('photo_id', $id)->get();

        return response()->json($comments);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'content' => ['required', 'max:100'],
        ]);

        Photo::findOrFail($id);

        Comment::create([
            'user_id' => auth()->id(),
            'photo_id' => $id,
            'content' => $request->content,
        ]);

        return response()->json(null, 201);
    }
}
