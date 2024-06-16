@extends('admin.layouts.admin')
@section('title')
    <title>Danh Sách Categories</title>
@endsection
@section('this-css')
    <link rel="stylesheet" href="{{asset('admins/css/bs513/bootstrap.css')}}">
    <style>
        .logo {
            max-width: 135px;
            height: 80px;
            object-fit: cover;
        }
        .banner {
            max-width: 230px;
            height: 80px;
            object-fit: cover;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .navbar-badge {
            right: -4.1px;
            top: -0px;
        }
        .badge {
            font-size: 0.65em;
            border-radius: 0.5rem;
        }
        .placeholder {
            min-height:38px;
        }
        .nav-item#category{
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }
    </style>
@endsection
@section('content')
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header',['name' => '', 'key' => 'Danh Sách Categories','url' => ''])

        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <form method="GET" action="{{ route('categories') }}" class="p-3">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted"
                                   value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_deleted">
                                Display hidden Categorys?
                            </label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
{{--                        <label for="search_term">Search</label>--}}
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                   aria-label="Search" value="{{ request('search_term', $searchTerm) }}"
                                   name="search_term">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 " style="display: flex; justify-content: end;">
                        <button type="button" class="btn btn-primary createCategory" data-bs-toggle="modal"
                                data-bs-target="#createCategoryModal">
                            Create new Category
                        </button>
                    </div>
                    <div class="div col-md-12">
                        <div id="categoryTable">
                            <table class="table">
                                <thead>
                                    <tr>
                                    @php
                                        $columns = [
                                         'id' => ['name' => 'ID', 'sortable' => true],
                                         'name' => ['name' => 'name', 'sortable' => true],
                                         'created_at' => ['name' => 'created_at', 'sortable' => true],
                                         'updated_at' => ['name' => 'updated_at', 'sortable' => true],

                                     ];
                                    @endphp

                                    @foreach($columns as $column => $details)
                                        <th>
                                            @if($details['sortable'])
                                                <a href="{{ route('categories', [
                                                        'sort_by' => $column,
                                                        'sort_direction' => $sortBy === $column && $sortDirection === 'asc' ? 'desc' : 'asc',
                                                        'search_term' => request('search_term', $searchTerm),
                                                        'show_deleted' => request('show_deleted', $showDeleted),
                                                        'page' => $categories->currentPage(), // Preserve current page

                                                    ]) }}">
                                                    {{ $details['name'] }}
                                                    @if($sortBy === $column)
                                                        <i class="fa fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                                    @endif
                                                </a>
                                            @else
                                                {{ $details['name'] }}
                                            @endif
                                        </th>
                                    @endforeach
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $category->id }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at }}</td>
                                        <td>{{ $category->updated_at }}</td>
                                        <td>
                                            <button style="margin-left: 15px !important;" type="button"
                                                    class="btn btn-primary edit-category" data-bs-toggle="modal"
                                                    data-bs-target="#editCategoryModal" data-categoryid="{{ $category->id }}">
                                                <i class="fas fa-edit"></i> Edit Category
                                            </button>
                                            <span id="delRes_{{$category->id}}">
                                                @if($category->deleted_at)
                                                    <button type="button" class="btn btn-success"
                                                            onclick="restoreCategory(this, {{ $category->id }})" title="Restore"
                                                            data-url="{{ route('categories.restore', $category->id) }}"
                                                            id="restoreBtn_{{ $category->id }}">
                                                        <i class="fas fa-undo"></i>
                                                </button>
                                                @else
                                                    <a title="Delete" href="javascript:void(0);" class="btn btn-danger delete-category"
                                                       onclick="deleteCategory(this, {{ $category->id }})"
                                                       data-url="{{ route('categories.delete', $category->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                @endif
                                            </span>

                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="col-md-12">
                                {{ $categories->appends([
                                    'sort_by' =>  request('sort_by', $sortBy),
                                    'sort_direction' =>  request('sort_direction', $sortDirection),
                                    'search_term' => request('search_term', $searchTerm),
                                    'show_deleted' => request('show_deleted', $showDeleted),
                                ])->links('vendor.pagination.bootstrap-4')}}
                            </div>


                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
        <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog"
             aria-labelledby="createCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCategoryModalLabel">Create New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form id="createCategoryModalForm" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Product Modal -->
        <div class="modal fade" id="editCategoryModal" tabindex="-1"
             aria-labelledby="editCategoryModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCategoryLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form id="editCategoryForm" enctype="multipart/form-data" class="placeholder-glow">
                        <div class="modal-body placeholder-glow">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="edit_name">Category Name</label>
                                    <input type="text" class="form-control" id="edit_name" name="name" required>
                                    <div class="invalid-feedback"></div>
                                    <span class="placeholder col-12"></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('this-js')
    <script src="{{asset('admins/js/bs513/bootstrap.bundle.js')}}"></script>
    <script>
        $(document).on('click', '.createCategory', function (e) {
            e.preventDefault();
            $('#createCategoryModalForm').on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                //reset validation signal
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
                $.ajax({
                    url: "{{ route('categories.store', '')}}", // Adjust route as necessary
                    type: 'POST',
                    data: formData,
                    processData: false, // Important for FormData
                    contentType: false, // Important for FormData
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                    success: function (response) {
                        if (response.success) {
                            location.reload()
                            console.log(response);
                            // $('#createProductItem').modal('hide');
                            // alertify.success(response.message)
                        } else {
                            alertify.error(response.message)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        var errors = xhr.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            console.log(key);
                            console.log(value);
                            var field = form.find('[name="' + key + '"]');
                            field.addClass('is-invalid');
                            field.next('.invalid-feedback').text(value);
                        });
                    }
                });
            });
        });
    </script>
    <script>

        $(document).on('click', '.edit-category', function (e) {
            // e.preventDefault();
            // return false;
            var categoryId = $(this).data('categoryid');
            // alertify.success('ho' + categoryId);
            // alertify.success(''+productDetailId+" "+productId);
            var $form = $('#editCategoryForm');
            // $form.reset();
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('.invalid-feedback').text('');
            $('#editCategoryLabel').text('Edit Category #' + categoryId);
            ///wait for 5s to continue
            $form.find('[name]').hide();
            $form.find('[type="submit"]').addClass('disabled');
            $form.find('.placeholder').show();
            $.ajax({
                url: "{{ route('categories.edit', '') }}/" + categoryId,
                type: 'GET',
                success: function (response) {
                    if (response.success) {
                        $form.find('[name]').show();
                        $form.find('[type="submit"]').removeClass('disabled');
                        $form.find('.placeholder').hide();
                        var category = response.category;
                        $('#edit_name').val(category.name);
                    } else {
                        alertify.error(response.message)
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching product detail data:", error);
                    alertify.error("Error fetching product detail data:", error);
                }
            });
            // Handle form submission for editing product
            $('#editCategoryForm').on('submit', function (e) {
                e.preventDefault();
                // e.stopPropagation()
                var form = $(this);
                var formData = new FormData(this);
                //reset validation signal
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
                $.ajax({
                    url: "{{ route('categories.update', '')}}/" + categoryId, // Adjust route as necessary
                    type: 'POST',
                    data: formData,
                    processData: false, // Important for FormData
                    contentType: false, // Important for FormData
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//important incase this code is in the blade and not in a separate js file
                    success: function (response) {
                        if (response.success) {
                            location.reload()
                            console.log(response);
                            // $('#createProductItem').modal('hide');
                            // alertify.success(response.message)
                        } else {
                            alertify.error(response.message)
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        var errors = xhr.responseJSON;
                        $.each(errors.errors, function (key, value) {
                            console.log(key);
                            console.log(value);
                            var field = form.find('[name="' + key + '"]');
                            field.addClass('is-invalid');
                            field.next('.invalid-feedback').text(value);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        function deleteCategory(button, categoryId) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + categoryId).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while deleting the category.');
                }
            });
        }

        function restoreCategory(button, categoryId) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + categoryId).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while restoring the category.');
                }
            });
        }

    </script>
@endsection





