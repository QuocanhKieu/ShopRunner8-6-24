@foreach($t_products as $t_product)
    @php
        $product = \App\Models\Product::find($t_product->product_id);
        $thumbImgPath = $product->productImages()->first()->path??'';

    @endphp
    <div class="d-flex " style="font-size: 1.1em">
        <img src="{{asset("front/img/product/$thumbImgPath")}}" style="max-width:75px">

        <div class="pl-3">
            <p class="text-primary ">Sold: {{$t_product->total_quantity_sold}}</p>
            <p class="text-secondary">{{$product->name}}</p>
        </div>
    </div>
    <hr class="mt-1">
@endforeach
