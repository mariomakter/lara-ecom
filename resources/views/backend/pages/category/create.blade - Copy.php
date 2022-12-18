@extends('backend.layouts.master')
@push('admin_style')
@endpush
@section('admin_content')
    <div class="row">
        <h1 class="d-flex justify-content-end">Category/create</h1>
        <div class="col-12">
            <div class="d-flex justify-content-start">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">
                    <i class="fas fa-backward"></i>
                    Back to Categories
                </a>
            </div>
        </div>

        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row" id="multi">
                            <div class="mb-3">
                                <label for="title" class="form-label">Category Title</label>
                            </div>
                            <div class="mb-3 col-10">
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title')
                        is-invalid
                    @enderror"
                                    placeholder="Enter category title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="mb-3 col-2">
                                <button type="button" id="add"><i class="fa-solid fa-plus"></i></button>
                            </div>
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
    <script>
        $('#add').click(function() {
            $('#multi').append(`
            <div class="row item">
                <div class="mb-3">
                    <label class="form-label">Category Title</label>
                </div>
                <div class="mb-3 col-10">
                    <input type="text" name="title[]" class="form-control" placeholder="Enter category title">
                </div>
                <div class="mb-3 col-2">
                    <button type="button" class="remove"><i class="fa-solid fa-minus"></i></button>
                </div>
            </div>
        `);
        });
        $(document).on('click', '.remove', function() {
            $(this).parents('.item').remove();
        });
    </script>
@endpush
