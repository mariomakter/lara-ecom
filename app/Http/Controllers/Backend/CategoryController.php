<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest('id')->select(['id', 'title', 'slug', 'updated_at'])->paginate();
        //return $categories;
        return view('backend.pages.category.index',compact('categories'));


    }

    public function create()
    {
       return view('backend.pages.category.create');
    }


    public function store(StoreCategoryRequest $request)
    {
         $test = Category::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
       ]);
    //    dd($test);

       Toastr::success('Data Store Successfully!');
       return redirect()->route('categories.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($slug)
    {
        $category = Category::whereSlug($slug)->first();
        return view('backend.pages.category.update', compact('category'));
    }


    public function update(UpdateCategoryRequest $request, $slug)
    {
        $category = Category::whereslug($slug)->first();
        $category->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'is_active' => $request->filled('is_active'),
        ]);
        Toastr::info('Data Updated Successfully!');
        return redirect()->route('categories.index');
    }


    public function destroy($slug)
    {
        $category = Category::whereSlug($slug)->first()->delete();
        Toastr::info('Data Deleted Successfully!');
        return redirect()->route('categories.index');

    }
}
