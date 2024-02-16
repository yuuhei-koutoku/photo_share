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

    public static function storePhoto($file, $userId)
    {
        $filenameWithExt = $file->getClientOriginalName();

        $file->storeAs('photos', $filenameWithExt, 'public');

        self::create([
            'user_id' => $userId,
            'file_name' => $filenameWithExt,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
