<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function getAllImages()
    {
        $images = Photo::all()->map(function ($photo) {
            return [
                'url' => Storage::url($photo->file_path)
            ];
        });

        return response()->json($images);
    }
}
