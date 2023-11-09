<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class InstallScript extends Command
{
    protected $signature = 'installscript';
    protected $description = 'Команда добавляет данные в БД';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Post $posts, Comment $comments, User $users)
    {
        $dataPosts = $posts->getAllPosts();

        foreach ($dataPosts as $post)
        {
            $key = $post['id'];
            $value = [
                'userId' => $post['userId'],
                'title'  => $post['title'],
                'body'   => $post['body'],
            ];
            DB::table('posts')->insert([
                'user_id' => $post['userId'],
                'title'  => $post['title'],
                'body'   => $post['body'],
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        }

        $dataComments = $comments->getAllComments();

        foreach ($dataComments as $comment)
        {
            $key = $comment['id'];
            $value = [
                'user_id' => $comment["id"],
                'post_id'  => $comment['postId'],
                'body'   => $comment['body'],
            ];


            DB::table('comments')->insert([
                'user_id' => $comment['id'],
                'post_id'  => $comment['postId'],
                'comment'   => $comment['body'],
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        }

        $dataUsers = $users->getAllUsers();
        foreach ($dataUsers as $user)
        {
            $key = $user['id'];
            $value = [
                'name'  => $user['name'],
                'email'   => $user['email'],

            ];

            DB::table('users')->insertOrIgnore([
                'name'  => $user['name'],
                'email'   => $user['email'],
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
        }


        $countUsers = Post::whereDate('created_at', Carbon::now())->count();
        $countUsers = DB::table('users')->whereDate('created_at', Carbon::now())->count();

        $countPosts = Post::whereDate('created_at', Carbon::now())->count();
        $countPosts = DB::table('posts')->whereDate('created_at', Carbon::now())->count();

        $countComments = Post::whereDate('created_at', Carbon::now())->count();
        $countComments = DB::table('comments')->whereDate('created_at', Carbon::now())->count();



        $this->info(
        "Данные были добавлены в базу.
        Добавлено пользователей: $countUsers,
        Добавлено постов: $countPosts,
        Добавлено комментариев: $countComments");
    }
}
