<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\String\s;

class PostController extends Controller
{
    public function showPostsForm()
    {
        $posts = Post::paginate(8);

        return view('posts',['posts'=>$posts]);
    }
    public function showPostForm($id)
    {
        $post = Post::find($id);

        $comments = Post::find($id)->comment;

        return view('post',compact('post','comments'));
    }

    public function searchComments(Request $request)
    {
        $request->validate(['search' => 'required']);
        $post = Post::find($request->id);


        $search = $request->search;

        $comments = Comment::query()
            ->where('comment', 'like',"%{$search}%")
            ->where('post_id',$post->id)
            ->get();
        return view('post',compact(['comments', 'post']));
    }

    public function searchPosts(Request $request)
    {
        $request->validate(['search' => 'required']);

        $posts = Post::paginate(8);

        $search = $request->search;

        $posts = Post::query()->where('title','like',"%{$search}%")->orderBy('created_at')->paginate(5);

        return view('posts',compact( 'posts'));
    }

}
