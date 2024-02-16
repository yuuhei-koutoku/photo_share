<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        try {
            $request->validate([
                'photo' => ['required', 'file', 'mimes:jpg,jpeg,png,gif']
            ]);

            $file = $request->file('photo');

            $userId = auth()->id();

            if (!$userId) {
                return response()->json(null, 401);
            }

            Photo::storePhoto($file, $userId);

            return response()->json(null, 201);
        } catch (\Exception $e) {
            Log::error('Photo upload failed: ' . $e->getMessage());
            return response()->json(null, 500);
        }
    }

    public function show($id)
    {
        $photo = Photo::with('user')->findOrFail($id);

        return response()->json($photo);
    }
}
