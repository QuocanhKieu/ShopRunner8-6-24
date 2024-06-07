@extends('admin.layouts.admin')

@section('title')
    <title>Danh Sách Sản Phẩm</title>
@endsection
@section('this-css')
    <link rel="stylesheet" href="{{asset('admins/css/select2.min.css')}}">
    <style>
        img {
            max-width: 230px;
            height: 80px;
            object-fit: cover;
        }

        .table td, .table th {
            vertical-align: middle;
        }

    </style>
@endsection
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('admin.partials.content-header',['name' => '', 'key' => 'Danh Sách Sản Phẩm','url' => ''])

        @php
            $FEATURES = App\Utilities\Constant::$FEATURES;
    //        $PAYMENT_STATUSES = App\Constants\OrderConstants::PAYMENTSTATUSES;
            $STATUS_COLORS = App\Utilities\Constant::STATUSCOLORS;
        @endphp
            <form class="form-inline ml-3" method="GET" action="{{ route('orders') }}">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                <input type="hidden" name="show_deleted" value="{{ request('show_deleted', $showDeleted) }}">
                <input type="hidden" name="page" value="{{ $products->currentPage() }}">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" value="{{ request('search_term', $searchTerm) }}" name="search_term">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        <div class="content">
            <form method="GET" action="{{ route('orders') }}" style="padding-left: 13px;">
                <input type="hidden" name="sort_by" value="{{ request('sort_by', $sortBy) }}">
                <input type="hidden" name="sort_direction" value="{{ request('sort_direction', $sortDirection) }}">
                <input type="hidden" name="search_term" value="{{ request('search_term', $searchTerm) }}">
                <input type="hidden" name="page" value="{{ $products->currentPage() }}">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="show_deleted" id="show_deleted" value="yes" {{ $showDeleted === 'yes' ? 'checked' : '' }}>
                    <label class="form-check-label" for="show_deleted">
                        Hiển thị Sản Phẩm đã ẩn
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Lọc</button>
            </form>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="display: flex; justify-content: end;">
                        <a href="{{route('products.create')}}" class="btn btn-primary m-2">Create Product</a>
                    </div>
                    <div class="div col-md-12">

                                <table class="table">
                                    <thead>
                                    <tr>
                                        @php
                                            $columns = [
                                             'id' => ['name' => 'ID', 'sortable' => true],
                                             'brand_id' => ['name' => 'brand', 'sortable' => true],
                                             'product_category_id' => ['name' => 'category', 'sortable' => true],
                                             'name' => ['name' => 'name', 'sortable' => true],
                                             'image' => ['name' => 'image', 'sortable' => false],
                                             'description' => ['name' => 'description', 'sortable' => true],
                                             'content' => ['name' => 'content', 'sortable' => true],
                                             'price' => ['name' => 'price', 'sortable' => true],
                                             'qty' => ['name' => 'total qty', 'sortable' => true],
                                             'sku' => ['name' => 'sku', 'sortable' => true],
                                             'featured' => ['name' => 'featured', 'sortable' => true],
                                             'tag' => ['name' => 'tag', 'sortable' => true],
                                             'notes' => ['name' => 'notes', 'sortable' => true],
                                             'additional_info' => ['name' => 'additional_info', 'sortable' => true],
                                             'created_at' => ['name' => 'created_at', 'sortable' => true],
                                         ];
                                        @endphp

                                        @foreach($columns as $column => $details)
                                            <th>
                                                @if($details['sortable'])
                                                    <a href="{{ route('orders', [
                                                        'sort_by' => $column,
                                                        'sort_direction' => $sortBy === $column && $sortDirection === 'asc' ? 'desc' : 'asc',
                                                        'search_term' => request('search_term', $searchTerm),
                                                        'show_deleted' => request('show_deleted', $showDeleted),
                                                        'page' => $products->currentPage(), // Preserve current page
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
                                    @foreach ($products as $product)
                                        @php
                                            $brand = $product->brand;
                                            $category = $product->productCategory;
                                            $thumbImgPath = $product->productImages()->first()->path;
                                         @endphp
                                        <tr>
                                            <th scope="row">{{ $product->id }}</th>
                                            <td>{{ $brand->name }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <img src="{{asset("front/img/product/$thumbImgPath")}}" style="max-width:75px">
                                            </td>
                                            <td>{{$product->description}}</td>
                                            <td>{{$product->content}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->qty}}</td>
                                            <td>{{$product->sku}}</td>
                                            <td>{{$FEATURES[$product->featured]}}</td>
                                            <!-- Accessing the name of the category -->
                                            <td>{{ $product->tag }}</td>
                                            <td>{{ $product->notes }}</td>
                                            <td>{{ $product->additional_info}}</td>
                                            <td>{{ $product->created_at }}</td>
                                            <td>
                                                <a href="{{ "route('products.edit', $product->id)" }}"
                                                   class="btn btn-primary">Edit</a>
                                                <div class="dropdown" style="margin-bottom: 5px; margin-right: 5px">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" id="actionOptions_{{$product->id}}">
                                                        <a class="dropdown-item" href="{{route('orders.orderDetails',['order'=> $product->id])}}"><i class="fas fa-eye"></i> Products Details</a>
                                                    </div>
{{--                                                    ....--}}
                                                </div>
                                                @if($product->deleted_at)
                                                    <button type="button" class="btn btn-success"
                                                            onclick="restoreOrder(this, {{ $product->id}})" title="Restore"
                                                            id="restoreBtn"> <i class="fas fa-undo"></i>
                                                    </button>
                                                @else
                                                    <a title="Delete" href="#" class="btn btn-danger delete-order" style="  "
                                                       data-url="{{ route('products.delete', $product->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                        <div class="col-md-12">
                            {{ $products->appends([
                                    'sort_by' =>  request('sort_by', $sortBy),
                                    'sort_direction' =>  request('sort_direction', $sortDirection),
                                    'show_deleted' => request('show_deleted', $showDeleted),
                                    'search_term' => request('search_term', $searchTerm),
                                ])->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
@endsection
@section('this-js')
    <script type="text/javascript">
        function toggleDeletedProduct(button, id) {
            console.log($(button));
            console.log(`enter function id ${id}`)
            var restoreBtn = document.getElementById('restoreBtn');
            // Send an AJAX request to fetch categories based on showDeleted value
            $.ajax({
                url: "{{ route('products.restore') }}",
                type: "put",
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    var deleteLink = $('<a>', {
                        href: "{{ route('products.delete', ':id') }}".replace(':id', id),
                        class: 'btn btn-danger',
                        onclick: "return confirm('Are you sure you want to delete this product?')",
                        text: 'Delete'

                    });
                    $(button).replaceWith(deleteLink);
                }
            });
        }
    </script>
@endsection






