<?php

namespace App\Http\Controllers;

use App\Models\CategoriaBlog;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('estado', 2)->latest('id')->paginate(8);

        return view('frontend.blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $similares = Post::where('categoria_blog_id', $post->categoria_blog_id)
            ->where('estado', 2)
            ->where('id', '!=', $post->id)
            ->latest('id')
            ->take(4)
            ->get();

        return view('frontend.blog.show', compact('post', 'similares'));
    }

    public function categoria(CategoriaBlog $category)
    {
        $posts = Post::where('categoria_blog_id', $category->id)
            ->where('estado', 2)
            ->lastest('id')
            ->paginate(6);

        return $posts;
    }

    public function tag(Tag $tag)
    {
        $posts = $tag->posts()->where('estado', 2)->latest('id')->paginate(4);

        return $posts;
    }
}
