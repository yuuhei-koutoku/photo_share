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
                'url' => Storage::url('photos/' . $photo->file_name)
            ];
        });

        return response()->json($images);
    }

    public function addImage(Request $request)
    {
        // バリデーション
        $request->validate([
            'photo' => 'required|file|mimes:jpg,jpeg,png,gif'
        ]);

        // リクエストからファイルの情報を取得する
        $file = $request->file('photo');

        // ユーザーIDを取得する
        $userId = auth()->id();

        // ユーザーIDがNULLの場合は、「ログインしてください。」と記載されたアラートを表示する
        if (!$userId) {
            return response()->json(['message' => 'You must be logged in to post photos'], 401);
        }

        // PhotoモデルのstorePhotoメソッドを実行する
        $photo = Photo::storePhoto($file, $userId);

        return response()->json([
            'message' => 'Success',
            'photo' => $photo
        ]);
    }
}
