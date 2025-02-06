@extends('admin.template.layout')

@section('title', 'Blogs')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"></span> Blogs
            </h4>

            <!-- Create Blog Button -->
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin-blog-create') }}" class="btn btn-primary">Create Blog</a>
            </div>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Blogs</h5>
                <div class="table-responsive text-nowrap">
                    @if($blogs->isEmpty())
                        <p class="text-center p-3">No blogs found.</p>
                    @else
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Created By</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach($blogs as $index => $blog)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $blog->created_at->format('d M, Y') }}</td>
                                    <td>{{ $blog->admin->name ?? 'N.A' }}</td>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if($blog->status == \App\Models\Blog::ACTIVE)
                                            <span class="badge bg-label-primary">Active</span>
                                        @else
                                            <span class="badge bg-label-secondary">In-Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editBlogModal-{{ $blog->id }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteBlog({{ $blog->id }})">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editBlogModal-{{ $blog->id }}" tabindex="-1"
                                     aria-labelledby="editBlogModalLabel-{{ $blog->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('admin-blog-update', $blog->id) }}" method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $blog->id }}">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editBlogModalLabel-{{ $blog->id }}">Edit
                                                        Blog</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Title<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="title"
                                                               value="{{ $blog->title }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>Short Description<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="short_description"
                                                               value="{{ $blog->short_description }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Content<span
                                                                class="text-danger">*</span></label>
                                                        <textarea name="description" class="summernote form-control"
                                                                  cols="30" rows="5"
                                                                  required>{{ $blog->description }}</textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-control" name="status" required>
                                                            <option
                                                                value="1" {{ $blog->status == 1 ? 'selected' : '' }}>
                                                                Active
                                                            </option>
                                                            <option
                                                                value="2" {{ $blog->status == 2 ? 'selected' : '' }}>
                                                                In-Active
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->
        </div>
        <!-- / Content -->
    </div>

@stop
@section('page-javascript')
    <script>
        function deleteBlog(id) {
            if (confirm('Are you sure you want to delete this blog?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@stop
