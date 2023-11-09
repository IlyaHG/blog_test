<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    public function getAllPosts()
    {
        $url = 'https://jsonplaceholder.typicode.com/posts';

        $listContent = file_get_contents($url);

        $dataArray = json_decode($listContent,true);

        return $dataArray;

    }
}
