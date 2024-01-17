<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'file_name',
    ];

    public function storePhoto($file, $userId)
    {
        // 拡張子付きでファイル名を取得する
        $filenameWithExt = $file->getClientOriginalName();

        // 写真をローカルストレージに保存
        $file->storeAs('photos', $filenameWithExt, 'public');

        // Photoインスタンスを生成する
        $photo = self::create([
            'user_id' => $userId,
            'file_name' => $filenameWithExt,
        ]);

        return $photo;
    }
}
