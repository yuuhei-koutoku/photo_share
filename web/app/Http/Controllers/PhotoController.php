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
                'id' => $photo->id,
                'url' => Storage::url('photos/' . $photo->file_name)
            ];
        });

        return response()->json($images);
    }

    public function addImage(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'file', 'mimes:jpg,jpeg,png,gif']
        ]);

        $file = $request->file('photo');

        $userId = auth()->id();

        if (!$userId) {
            return response()->json(null, 401);
        }

        $photo = Photo::storePhoto($file, $userId);

        return response()->json([
            'message' => 'Success',
            'photo' => $photo
        ]);
    }

    public function show($id)
    {
        $photo = Photo::with('user')->findOrFail($id);

        return response()->json($photo);
    }
}
