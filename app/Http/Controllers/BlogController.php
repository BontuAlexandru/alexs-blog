<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function show(Post $post)
    {
        return view('blog.show', compact( 'post'));
    }

    public function about()
    {
        return view('blog.about');
    }

    public function category()
    {
        $categories = Category::with('posts')->simplePaginate(10);
        $posts = Post::with('user', 'category')->simplePaginate(3);

        return view('blog.category', compact('categories', 'posts'));
    }

    public function contact()
    {
        return view('blog.contact');
    }
}
