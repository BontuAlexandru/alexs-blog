<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $posts =  Post::with('category')->searched()->simplePaginate(4);

        return view('welcome', compact('categories', 'tags', 'posts'));
    }
}
