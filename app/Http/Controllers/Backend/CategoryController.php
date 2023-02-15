<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::latest('id')->select(['id', 'title','category_image', 'slug', 'updated_at'])->paginate();
        //return $categories;
        return view('backend.pages.category.index',compact('categories'));


    }

    public function create()
    {
       return view('backend.pages.category.create');
    }


    public function store(StoreCategoryRequest $request)
    {
         $category = Category::create([
        'title' => $request->title,
        'slug' => Str::slug($request->title),
       ]);
    //    dd($test);
       $this->image_upload($request, $category->id);

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

        $this->image_upload($request, $category->id);

        Toastr::info('Data Updated Successfully!');
        return redirect()->route('categories.index');
    }


    public function destroy($slug)
    {
        $category = Category::whereSlug($slug)->first()->delete();
        Toastr::info('Data Deleted Successfully!');
        return redirect()->route('categories.index');

    }

    public function image_upload($request, $item_id){
        $category = Category::findorFail($item_id);
        //dd($request->all(), $request->hasFile('category_image'));
        if($request->hasFile('category_image')){
            if($category->category_image != 'default-image.jpg'){
                $photo_location = 'public/uploads/category/';
                $old_photo_location = $photo_location .$category->category_image;
                if(file_exists($old_photo_location)){
                    unlink($old_photo_location);
                }
                $photo_location = 'public/uploads/category/';
                $uploaded_photo = $request->file('category_image');
                $new_photo_name = $category->id . '.' .$uploaded_photo->getClientOriginalExtension();
                $new_photo_location = $photo_location .$new_photo_name;
                Image::make($uploaded_photo)->resize(105, 105)->save(base_path($new_photo_location),40);
                $check = $category->update([
                    'category_image' => $new_photo_name,
                ]);

            }
        }
    }
}
