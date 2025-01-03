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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createBlogModal">
                    Create Blog
                </button>
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
                                        <a href="{{ route('admin-blog-update', ['id' => $blog->id]) }}"
                                           class="btn btn-info btn-sm">Edit</a>
                                        <button class="btn btn-danger btn-sm" onclick="deleteBlog({{ $blog->id }})">
                                            Delete
                                        </button>
                                        <form id="delete-form-{{ $blog->id }}"
                                              action="{{ route('admin-blog-delete', $blog->id) }}" method="POST"
                                              style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
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
