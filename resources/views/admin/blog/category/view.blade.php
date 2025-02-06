@extends('admin.template.layout')

@section('title', 'Blog Category')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Tables /</span> Blog Categories
            </h4>

            <!-- Create Category Button -->
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#createCategoryModal">
                    Create Category
                </button>
            </div>

            <!-- Basic Bootstrap Table -->
            <div class="card">
                <h5 class="card-header">Blog Categories</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Created By</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach($categories as $index => $category)
                            <tr>
                                <td>#</td>
                                <td>{{ $category->created_at->format('d M, Y') }}</td>
                                <td>{{ $category->admin->name ?? 'N.A' }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @if($category->status == \App\Models\BlogCategory::ACTIVE)
                                        <span class="badge bg-label-primary">Active</span>
                                    @else
                                        <span class="badge bg-label-primary">In-Active</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal-{{ $category->id }}">
                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                    </button>
                                    <a class="btn btn-danger btn-sm" href="javascript:void(0);"
                                       onclick="deleteCategory({{ $category->id }})">
                                        <i class="bx bx-trash me-1"></i> Delete</a>
                                    <form id="delete-form-{{ $category->id }}"
                                          action="{{ route('admin-blog-category-delete', $category->id) }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Category Modal -->
                            <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1"
                                 aria-labelledby="editCategoryModalLabel-{{ $category->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin-blog-category-update', $category->id) }}"
                                              method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $category->id }}">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editCategoryModalLabel-{{ $category->id }}">
                                                    Edit Blog Category
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name-{{ $category->id }}"
                                                           class="form-label">Name</label>
                                                    <input type="text" class="form-control"
                                                           id="name-{{ $category->id }}"
                                                           name="name" value="{{ $category->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status-{{ $category->id }}"
                                                           class="form-label">Status</label>
                                                    <select class="form-control" id="status-{{ $category->id }}"
                                                            name="status" required>
                                                        <option
                                                            value="1" {{ $category->status == 1 ? 'selected' : '' }}>
                                                            Active
                                                        </option>
                                                        <option
                                                            value="2" {{ $category->status == 2 ? 'selected' : '' }}>
                                                            In-Active
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Edit Category Modal -->
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Basic Bootstrap Table -->

            <!-- Create Category Modal -->
            <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="POST">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="createCategoryModalLabel">Create Blog Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">In-Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Create Category Modal -->
        </div>
        <!-- / Content -->
    </div>

@stop
@section('page-javascript')
    <script>
        function deleteCategory(id) {
            if (confirm('Are you sure you want to delete this category?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@stop
