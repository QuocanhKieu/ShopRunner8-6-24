@php use App\Utilities\Constant; @endphp

@extends('admin.layouts.admin')
@section('title')
    <title>Danh Sách Permission</title>
@endsection
@section('this-css')

    <link rel="stylesheet" href="{{asset('admins/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admins/css/bs513/bootstrap.css')}}">
    <style>
        .select2 {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--multiple {
            height: auto;
        }

        .select2-selection__choice {
            background-color: #3b3b3b !important;
        }

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
            min-height: 38px;
        }
        .nav-item#permission {
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }
        th {
            text-align: center ;
        }
    </style>
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header',['name' => '', 'key' => 'Danh Sách Permission','url' => ''])
        <hr style="margin-block: 5px;">
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <form method="GET" action="{{ route('permissions') }}" class="p-3">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted"
                                   value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="show_deleted">
                                Display hidden Permissions?
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
                    <div class="col-md-12" style="display: flex; justify-content: end;">
                        <button type="button" class="btn btn-primary createPermission" data-bs-toggle="modal"
                                data-bs-target="#createPermissionModal">
                            Create new Permission
                        </button>
                    </div>
                    <div class="div col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                @php
                                    $columns = [
                                     'id' => ['name' => 'id', 'sortable' => true],
                                     'name' => ['name' => 'name', 'sortable' => true],
                                     'group' => ['name' => 'group', 'sortable' => true],
                                     'description' => ['name' => 'description', 'sortable' => true],
                                     'created_at' => ['name' => 'created_at', 'sortable' => true],
                                     'updated_at' => ['name' => 'updated_at', 'sortable' => true],
                                 ];
                                @endphp

                                @foreach($columns as $column => $details)
                                    <th>
                                        @if($details['sortable'])
                                            <a href="{{ route('permissions', [
                                                        'sort_by' => $column,
                                                        'sort_direction' => $sortBy === $column && $sortDirection === 'asc' ? 'desc' : 'asc',
                                                        'search_term' => request('search_term', $searchTerm),
                                                        'show_deleted' => request('show_deleted', $showDeleted),
                                                        'page' => $permissions->currentPage(), // Preserve current page
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
                            @foreach ($permissions as $permission)
                                <tr>
                                    <th scope="row">{{ $permission->id }}</th>
                                    <td>{{ $permission->name??'' }}</td>
                                    <td>{{ $permission->group??'' }}</td>
                                    <td>{{ $permission->description??'' }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>{{ $permission->updated_at }}</td>
                                    <td>
                                        <button style="margin-left: 15px !important;" type="button"
                                                class="btn btn-primary edit-permission" data-bs-toggle="modal"
                                                data-bs-target="#editPermissionModal" data-id="{{ $permission->id }}">
                                            <i class="fas fa-edit"></i> Edit Permission
                                        </button>
                                        <span id="delRes_{{$permission->id}}">
                                             @if($permission->deleted_at)
                                                <button type="button" class="btn btn-success"
                                                        onclick="restorePermission(this, {{ $permission->id }})" title="Restore"
                                                        data-url="{{ route('permissions.restore', $permission->id) }}"
                                                        id="restoreBtn_{{ $permission->id }}">
                                                        <i class="fas fa-eye"></i>
                                                </button>
                                            @else
                                                <a title="Hide" href="javascript:void(0);" class="btn btn-danger delete-permission"
                                                   onclick="deletePermission(this, {{ $permission->id }})"
                                                   data-url="{{ route('permissions.delete', $permission->id) }}">
                                                    <i class="fas fa-eye-slash"></i>
                                                </a>
                                            @endif
                                        </span>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {{ $permissions->appends([
                                    'sort_by' =>  request('sort_by', $sortBy),
                                    'sort_direction' =>  request('sort_direction', $sortDirection),
                                    'search_term' => request('search_term', $searchTerm),
                                    'show_deleted' => request('show_deleted', $showDeleted),
                                ])->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="createPermissionModal" tabindex="-1" role="dialog"
         aria-labelledby="createPermissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPermissionModalLabel">Create New Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="createPermissionModalForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Permission Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="form-group">
                            <label for="group">Permission Group</label>
                            <select class="form-control" id="group" name="group"
                                    required>
                                @foreach(Constant::$PERMISSION_CONTROLLERS as $controller)
                                    <option value="{{ $controller }}">{{ $controller }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                            <div class="invalid-feedback"></div>
                        </div>

                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editPermissionModal" tabindex="-1"
         aria-labelledby="editPermissionModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPermissionLabel">Edit Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form id="editPermissionForm" enctype="multipart/form-data" class="placeholder-glow">
                    <div class="modal-body placeholder-glow">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit_name">Permission Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name" required>
                                <div class="invalid-feedback"></div>
                                <span class="placeholder col-12"></span>
                            </div>
                            <div class="form-group">
                                <label for="edit_group">Permission Group</label>
                                <select class="form-control" id="edit_group" name="group"
                                        required>
                                    @foreach(Constant::$PERMISSION_CONTROLLERS as $controller)
                                        <option value="{{ $controller }}">{{ $controller }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                                <span class="placeholder col-12"></span>

                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="edit_description">Description</label>
                                <textarea class="form-control" id="edit_description" name="description"></textarea>
                                <div class="invalid-feedback"></div>
                                <span class="placeholder col-12"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Permission</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('this-js')
    <script src="{{asset('admins/js/select2.min.js')}}"></script>
    <script src="{{asset('admins/js/bs513/bootstrap.bundle.js')}}"></script>

    <script>
        $(document).on('click', '.createPermission', function (e) {
            e.preventDefault();
            $('#createPermissionModalForm').on('submit', function (e) {
                e.preventDefault();
                var form = $(this);
                var formData = new FormData(this);
                //reset validation signal
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
                $.ajax({
                    url: "{{ route('permissions.store', '')}}", // Adjust route as necessary
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

        $(document).on('click', '.edit-permission', function (e) {
            // e.preventDefault();


            // return false;
            var id = $(this).data('id');
            // alertify.success('ho' + permissionId);
            // alertify.success(''+productDetailId+" "+productId);
            var $form = $('#editPermissionForm');
            // $form.reset();
            $form.find('.is-invalid').removeClass('is-invalid');
            $form.find('.invalid-feedback').text('');
            $('#editPermissionLabel').text('Edit Permission #' + id);
            ///wait for 5s to continue
            $form.find('[name]').hide();
            $form.find('[type="submit"]').addClass('disabled');
            $form.find('.placeholder').show();
            $.ajax({
                url: "{{ route('permissions.edit', '') }}/" + id,
                type: 'GET',
                success: function (response) {
                    $form.find('[name]').show();
                    $form.find('[type="submit"]').removeClass('disabled');
                    $form.find('.placeholder').hide();
                    var  permission = response.permission;
                    $('#edit_name').val(permission.name);
                    $('#edit_group').val(permission.group);
                    $('#edit_description').val(permission.description);
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching product detail data:", error);
                }
            });
            // Handle form submission for editing product
            $('#editPermissionForm').on('submit', function (e) {
                e.preventDefault();
                // e.stopPropagation()
                var form = $(this);
                var formData = new FormData(this);
                //reset validation signal
                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');
                $.ajax({
                    url: "{{ route('permissions.update', '')}}/" + id, // Adjust route as necessary
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
        function deletePermission(button, id) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + id).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while deleting the permission.');
                }
            });
        }

        function restorePermission(button, id) {
            const url = $(button).data('url');

            $.ajax({
                url: url,
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    if (response.success) {
                        alertify.success(response.message);
                        $('#delRes_' + id).html(response.html);
                    } else {
                        alertify.error(response.message);
                    }
                },
                error: function (xhr) {
                    alertify.error('An error occurred while restoring the permission.');
                }
            });
        }

    </script>
@endsection





