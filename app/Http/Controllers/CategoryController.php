<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
   public function index()
   {
        $categories = Category::with('posts')->get();

        return view('categories.index', compact('categories'));
   }

   public function create()
   {
        return view('categories.create');
   }

   public function edit(Category $category)
   {
       return view('categories.create', compact('category'));
   }

   public function store(CreateCategoryRequest $request)
   {
        Category::create($request->validated());

        Session::flash('success', 'The category was created successfully!');
        return redirect(route('categories.index'));
   }

   public function update(UpdateCategoryRequest $request, Category $category)
   {
       $category->update($request->validated());
       $category->save();

       Session::flash('success', 'Category updated successfully!');
       return redirect(route('categories.index'));
   }

   public function destroy(Category $category)
   {
       if ($category->posts->count() > 0)
       {
           Session::flash('alert', 'Category cannot be deleted because it has some posts.');
           return redirect(route('categories.index'));
       }
       $category->delete();

       Session::flash('success', 'Category deleted successfully!');
       return redirect(route('categories.index'));
   }
}

