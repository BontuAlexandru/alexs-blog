<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::with('posts')->get();

        return view('tags.index', compact('tags'));
    }


    public function create()
    {
        return view('tags.create');
    }

    public function store(CreateTagRequest $request)
    {
        Tag::create($request->validated());

        Session::flash('success', 'Tag created successfully!');
        return redirect(route('tags.index'));
    }


    public function edit(Tag $tag)
    {
        return view('tags.create', compact('tag'));
    }


    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update($request->validated());
        $tag->save();

        Session::flash('success', 'Tag updated successfully!');
        return redirect(route('tags.index'));
    }

    public function destroy(Tag $tag)
    {
        if ($tag->posts->count() > 0)
        {
            Session::flash('alert', 'Tag cannot be deleted, because it is associated to some posts.');
            return redirect(route('tags.index'));
        }
        $tag->delete();

        Session::flash('success', 'Tag deleted successfully!');
        return redirect(route('tags.index'));
    }
}
