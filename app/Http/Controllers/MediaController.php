<?php

namespace App\Http\Controllers;

use App\Models\Post;

class MediaController extends Controller
{
    public function show($path = null)
    {
//        $post = Post::query()->where('id', 55)->first()->getFirstMedia('xx')->getUrl();
        return Post::query()->where('id', 55)->first()->getFirstMedia('xx');
        return Post::query()->where('id', 55)->first();
        echo '<pre dir="ltr">';
        var_dump($rer);
        echo '</pre>';
        die();

//        return asset('media/14/YJaq5j31oLvbCSeOr0xe-0.03700800-1637473499.png');
        $path = 'media/14/YJaq5j31oLvbCSeOr0xe-0.03700800-1637473499.png';

        return public_path();
        $post = (new Post);
        $post->addMedia(public_path('media/14/YJaq5j31oLvbCSeOr0xe-0.03700800-1637473499.png'));

        return $post;
//        return Post::addMedia(storage_path('media/14/YJaq5j31oLvbCSeOr0xe-0.03700800-1637473499.png'))->toMediaCollection();
//        return response()->download('post.image', 'YJaq5j31oLvbCSeOr0xe-0.03700800-1637473499.png');
//        return public_path('media\\13\\' . $path);
        return (new Post)->addMedia(public_path('media/14/YJaq5j31oLvbCSeOr0xe-0.03700800-1637473499.png'))->toMediaCollection('post/image');
    }
}
