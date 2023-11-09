<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getAllComments()
    {
        $url = 'https://jsonplaceholder.typicode.com/comments';

        $listContent = file_get_contents($url);

        $dataArray = json_decode($listContent,true);

        return $dataArray;

    }
}
