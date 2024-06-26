@extends('front.layout.master')
@section('title','Product Details')
@section('body')
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="./">Home</a>
                            <a href="./shop">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="front/img/product/{{$product->productImages[0]->path}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="front/img/product/{{$product->productImages[1]->path}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="front/img/product/{{$product->productImages[2]->path}}">
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="front/img/product/{{$product->productImages[3]->path}}">
                                        <i class="fa fa-play"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="front/img/product/{{$product->productImages[0]->path}}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="front/img/product/{{$product->productImages[1]->path}}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="front/img/product/{{$product->productImages[2]->path}}" alt="">
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="front/img/product/{{$product->productImages[3]->path}}" alt="">
                                    <a href="front/img/product/{{$product->productImages[3]->path}}" class="video-popup"><i class="fa fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{$product->name}}</h4>
                            <div class="rating">
                              @for($i = 1;$i <=5;$i++)
                                @if($i <= $product->avgRating)
                                    <i class="fa fa-star"></i>
                                @else
                                    <i class="fa fa-star-o"></i>
                                @endif
                              @endfor
                                <span> - {{count($product->productComments)}} Reviews</span>
                            </div>
                            @if($product->discount != null)
                            <h3>${{$product->discount}} <span>${{$product->price}}</span></h3>
                            @else
                                <h3>${{$product->price}} <span></span></h3>
                            @endif
                            <p>Coat with quilted lining and an adjustable hood. Featuring long sleeves with adjustable
                                cuff tabs, adjustable asymmetric hem with elastic side tabs and a front zip fastening
                            with placket.</p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    @php
                                        $selectedSize = null; // Khởi tạo biến $selectedSize
                                    @endphp

                                    @foreach(array_unique(array_column($product->productDetails->toArray(),'size')) as $size)
                                        @php
                                            // Đặt biến flag để kiểm tra xem đã chọn size hay chưa
                                            $selected = false;
                                            if (!$selectedSize && !$selected) {
                                                $selectedSize = $size; // Lưu size đầu tiên vào biến $selectedSize
                                                $selected = true; // Đặt flag đã chọn size
                                            }
                                        @endphp
                                        <label for="{{$size}}">
                                            {{$size}}
                                            <input type="radio" name="size" id="{{$size}}" value="{{$size}}" @if($selected) checked @endif>
                                        </label>
                                    @endforeach

                                </div>
                                <div class="product__details__option__color">
                                    <span>Color:</span>
                                    @foreach(array_unique(array_column($product->productDetails->toArray(), 'color')) as $productColor)
                                        @php
                                            // Chuyển đổi giá trị màu thành tên màu dựa trên cơ sở dữ liệu.
                                            $colorNumber = "";
                                            switch ($productColor) {
                                                case 'black':
                                                    $colorNumber = '1';
                                                    break;
                                                case 'darkblue':
                                                    $colorNumber = '2';
                                                    break;
                                                case 'orange':
                                                    $colorNumber = '3';
                                                    break;
                                                case 'grey':
                                                    $colorNumber = '4';
                                                    break;
                                                case 'lightblack':
                                                    $colorNumber = '5';
                                                    break;
                                                case 'pink':
                                                    $colorNumber = '6';
                                                    break;
                                                case 'violet':
                                                    $colorNumber = '7';
                                                    break;
                                                case 'red':
                                                    $colorNumber = '8';
                                                    break;
                                                case 'white':
                                                    $colorNumber = '9';
                                                    break;

                                            }
                                        @endphp

                                        <label class="c-{{ $colorNumber }}" for="sp-{{ $colorNumber }}">
                                            <input type="radio" name="color" value="{{ $colorNumber }}" id="sp-{{ $colorNumber }}">
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty-2">
                                        <input id="product-qty" name="qty" type="text" value="1">
                                    </div>
                                </div>
                                <input type="hidden" id="{{$product->id}}" value="1234">
                                <div onclick="addCart({{$product->id }},document.getElementById('product-qty').value)" class="primary-btn add-details">add to cart</div>
                            </div>
                            <div class="product__details__btns__option">
                                <a href="javascript:addFav({{$product->id}})"><i class="fa fa-heart"></i> add to wishlist</a>
                                <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
                                <img src="front/img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span>{{$product->sku}}</li>
                                    <li><span>Categories:</span> {{$product->productCategory->name}}</li>
                                    <li><span>Brand:</span> {{$product->brand->name}}</li>
                                    <li><span>Tag:</span> {{$product->tag}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews({{count($product->productComments)}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">{{$product->notes}}</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>{!!$product->description!!}</p>

                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Feature</h5>
                                            <p>{!! $product->content !!}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <div class="customer-review-option">
                                                <h4>{{count($product->productComments)}} Comments</h4>
                                                    <div class="comment-option">
                                                    @foreach($product->productComments as $productComment)
                                                    <div class="co-item">
                                                        <div class="avatar-pic">
                                                            <img src="front/img/user/{{$productComment->user->avatar ?? 'default-avatar.png'}}" alt="">
                                                        </div>
                                                        <div class="avatar-text">
                                                            <div class="rating">
                                                                @for($i = 1;$i <=5;$i++)
                                                                    @if($i <= $productComment->rating)
                                                                        <i class="fa fa-star"></i>
                                                                    @else
                                                                        <i class="fa fa-star-o"></i>
                                                                    @endif
                                                                @endfor

                                                            </div>
                                                            <h5>{{$productComment->name}} <span>{{date('M d,Y', strtotime($productComment->created_at))}}</span></h5>
                                                            <div class="at-reply">{{$productComment->messages}}</div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                    <div class="leave-comment">
                                                        <h4>What do you think this product</h4>
                                                        <form action="" method="POST" class="comment-form">
                                                            @csrf

                                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id ?? null}}">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <input name="name" type="text" placeholder="Name">
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <input name="email" type="text" placeholder="Email">
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <textarea name="messages" placeholder="Messages"></textarea>

                                                                    <div class="personal-rating">
                                                                        <h6>Your Rating</h6>
                                                                        <div class="rate">
                                                                            <input type="radio" id="star5" name="rating" value="5" />
                                                                            <label for="star5" title="text">5 stars</label>
                                                                            <input type="radio" id="star4" name="rating" value="4" />
                                                                            <label for="star4" title="text">4 stars</label>
                                                                            <input type="radio" id="star3" name="rating" value="3" />
                                                                            <label for="star3" title="text">3 stars</label>
                                                                            <input type="radio" id="star2" name="rating" value="2" />
                                                                            <label for="star2" title="text">2 stars</label>
                                                                            <input type="radio" id="star1" name="rating" value="1" />
                                                                            <label for="star1" title="text">1 star</label>
                                                                        </div>
                                                                    </div>
                                                                    <button type="submit" class="site-btn">Send message</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                    </div>

                                <div class="tab-pane" id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note"></p>
                                        <div class="product__details__tab__content__item">
                                            {!! $product->additional_info !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @foreach($relatedProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="front/img/product/{{$product->productImages[0]->path}}">
                            @if($product->discount != null)
                            <span class="label">Sale</span>
                            @endif
                            <ul class="product__hover">
                                <li><a href="#"><img src="front/img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="front/img/icon/compare.png" alt=""> <span>Compare</span></a></li>
                                <li><a href="#"><img src="front/img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6>{{$product->name}}</h6>

                            <a href="javascript:addCart({{$product->id}})" class="add-cart">+ Add To Cart</a>
                            <a href="shop/product/{{$product->id}}" class="quick-view"><i class="fa fa-eye"></i>Quick view</a>
                            <div class="rating">
                                @php
                                    // Tìm đánh giá của sản phẩm hiện tại dựa trên product_id
                                    $rating = $productRating->where('product_id', $product->id)->first();
                                @endphp

                                @if($rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating->rating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                @else

                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                @endif
                            </div>
                            @if($product->discount != null)
                                <h5>${{$product->discount}} <span class="related-discount-span">${{$product->price}}</span></h5>
                            @else
                                <h5>${{$product->price}} <span></span></h5>
                            @endif
                            <div class="product__color__select">
                                @foreach(array_unique(array_column($product->productDetails->toArray(), 'color')) as $productColor)
                                    @php
                                        // Chuyển đổi giá trị màu thành tên màu dựa trên cơ sở dữ liệu.
                                        $colorNumber = "";
                                        switch ($productColor) {
                                            case 'black':
                                                $colorNumber = 'black';
                                                $colorPicker = 1;
                                                break;
                                            case 'darkblue':
                                                $colorNumber = 'darkblue';
                                                $colorPicker = 2;
                                                break;
                                            case 'orange':
                                                $colorNumber = 'orange';
                                                $colorPicker = 3;
                                                break;
                                            case 'grey':
                                                $colorNumber = 'grey';
                                                $colorPicker = 4;
                                                break;
                                            case 'lightblack':
                                                $colorNumber = 'lightblack';
                                                $colorPicker = 5;
                                                break;
                                            case 'pink':
                                                $colorNumber = 'pink';
                                                $colorPicker = 6;
                                                break;
                                            case 'violet':
                                                $colorNumber = 'violet';
                                                $colorPicker = 7;
                                                break;
                                            case 'red':
                                                $colorNumber = 'red';
                                                $colorPicker = 8;
                                                break;
                                            case 'white':
                                                $colorNumber = 'white';
                                                $colorPicker = 9;
                                                break;

                                        }
                                    @endphp

                                    <label class="{{$colorNumber}}" for="pc-{{$colorPicker}}">
                                        <input type="radio" id="pc-{{$colorPicker}}">
                                    </label>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->

@endsection
