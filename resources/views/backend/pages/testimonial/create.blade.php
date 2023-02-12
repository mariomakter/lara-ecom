@extends('backend.layouts.master')
@push('admin_style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('admin_content')
<div class="row">
    <h1 class="d-flex justify-content-end">Testimonial/create</h1>
    <div class="col-12">
        <div class="d-flex justify-content-start">
            <a href="{{ route('testimonial.index') }}" class="btn btn-primary">
                <i class="fas fa-backward"></i>
                Back to Testimonial
            </a>
        </div>
    </div>

    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="client_name" class="form-label">Client Name</label>
                    <input type="text" name="client_name" id="client_name" class="form-control @error('client_name')
                        is-invalid
                    @enderror" placeholder="Enter Client Name">
                    @error('client_name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Client Designation</label>
                    <input type="text" name="client_designation" id="client_designation" class="form-control @error('client_designation')
                        is-invalid
                    @enderror" placeholder="Enter Client Designation">
                    @error('client_designation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Client Message</label>
                    <input type="text" name="client_message" id="client_message" class="form-control @error('client_message')
                        is-invalid
                    @enderror" placeholder="Enter Client Message">
                    @error('client_message')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Client Image</label>
                    <input type="file" name="client_image" id="client_image" class="form-control dropify @error('client_image')
                        is-invalid
                    @enderror" placeholder="Client Image">
                    @error('client_image')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>


                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" id="is_active" checked>
                    <label class="form-check-label" for="flexSwitchCheckChecked">Active or Inactive</label>
                </div>

                  <div class="mt-5">
                    <button type="submit" class="btn btn-success">store</button>
                  </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('admin_script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.dropify').dropify();
</script>
@endpush
