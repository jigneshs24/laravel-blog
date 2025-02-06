@extends('admin.template.layout')

@section('title', 'Create Blogs')

@section('content')

    <div class="container mt-5">
        <div class="card col-md-10 mx-auto">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title<span class="text-danger">*</span></label>
                                <input type="text" name="title" value="{{ old('title') }}" placeholder="Blog Title"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Blog Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $index => $category)
                                        <option
                                            value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{--                        <div class="col-md-6 mt-3">--}}
                        {{--                            <div class="form-control">--}}
                        {{--                                <label>Blog Banner Image<span class="text-danger">*</span></label>--}}
                        {{--                                <input type="file" name="image" id="image">--}}
                        {{--                            </div>--}}
                        {{--                            <small class="text-muted d-block">Upto 3 MB | Min. 300 X 300 pixels image is--}}
                        {{--                                required</small>--}}
                        {{--                        </div>--}}
                        <div class="col-md-12 mt-2">
                            <label> Short Description<span class="text-danger">*</span></label>

                            <input type="text" class="form-control" value="" name="short description"
                                   data-ub-tag-variant="primary">
                        </div>

                        <div class="col-md-12 mt-1">
                            <div class="form-group">
                                <label class="form-label">Content <span class="text-danger">*</span></label>
                                <textarea name="description" class="summernote form-control" cols="30"
                                          rows="5">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-danger">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
