<?php

namespace App\Http\Controllers\Backend;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StoreTestimonialRequest;

class TestimonialController extends Controller
{

    public function index()
    {
       $testimonials = Testimonial::latest('id')
                ->select(['id', 'client_name', 'client_name_slug',
                 'client_designation', 'client_message', 'client_image', 'updated_at'])
                 ->paginate(5);
       return view('backend.pages.testimonial.index', compact('testimonials'));
    }

    public function create()
    {
        return view('backend.pages.testimonial.create');
    }


    public function store(StoreTestimonialRequest $request)
    {
    //    dd($request->all());
        $testimonial = Testimonial::create([
            'client_name' => $request->client_name,
            'client_name_slug' => Str::slug($request->client_name),
            'client_designation' => $request->client_designation,
            'client_message' => $request->client_message,
        ]);

        $this->image_upload($request,$testimonial->id);

        Toastr::success('Data Stored Successfully');
        return redirect()->route('testimonial.index');
    }

    public function image_upload($request, $item_id){
        $testimonial = Testimonial::findorFail($item_id);
    //     dd($request->all(), $testimonial,
    // $request->hash_File('client_image'));
    if($request->hasFile('client_image')){
        if($testimonial->client_image != 'default-client.jpg'){
            $photo_location = 'public/uploads/testimonials/';
            $old_photo_location = $photo_location .$testimonial->client_image;
            if(file_exists($old_photo_location)){
                unlink(base_path($old_photo_location));
            }
        }
        $photo_location = 'public/uploads/testimonials/';
        $uploaded_photo = $request->file('client_image');
        $new_photo_name = $testimonial->id . '.' .$uploaded_photo->getClientOriginalExtension();
        $new_photo_location = $photo_location . $new_photo_name;
        Image::make($uploaded_photo)->resize(105,105)->save(base_path($new_photo_location), 40);
        $check = $testimonial->update([
            'client_image' => $new_photo_name,
        ]);
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
