<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $posts =  Post::with('user')->orderBy('created_at', 'desc')->simplePaginate(5);

        return view('welcome', compact( 'posts'));
    }
}
