<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\UpdateePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }

    public function index()
    {
        $posts = Post::with('category', 'user')->simplePaginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags'));
    }


    public function store(CreatePostRequest $request)
    {
        $filename = $request->image->getClientOriginalName();
        $imageName = time().'.'.$filename;

        $post =  Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->get('content'),
            'image' =>$request->image->storeAs('images/posts', $imageName, 'public'),
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id
    ]);

        if ($request->hasFile('image')){
            $post->update(['image' => $imageName]);
        }

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        Session::flash('success', 'Post created successfully!');
        return redirect(route('posts.index'));
    }


    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.create', compact('categories', 'tags', 'post'));
    }


    public function update(UpdateePostRequest $request, Post $post)
    {
        if ($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $imageName = time().'.'.$filename;
            $post->deleteImage();
            $request->image->storeAs('images/posts', $imageName, 'public');
            $post->update(['image' => $imageName]);
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }
        $post->update($request->validated());

        Session::flash('success', 'Post updated successfully!');
        return redirect(route('posts.index'));
    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed())
        {
            $post->deleteImage();
            $post->forceDelete();
            Session::flash('success', 'Post deleted successfully!');
        }else{
            Session::flash('success', 'Post trashed successfully!');
            $post->delete();
        }
        return redirect(route('posts.index'));
    }

    public function trashed()
    {
        $trashed = Post::with('category', 'user')->onlyTrashed()->simplePaginate(5);

        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();;
        $post->restore();

        Session::flash('success', 'Post restored successfully!');
        return redirect(route('posts.index'));
    }
}
