@if(trim($productComment->shop_response??''))
    <i class="fas fa-check-circle reviewResponseWarning" id="reviewResponseWarning_{{$productComment->id}}" style="    color: #00ad00;
    font-size: 1.2em;"></i>
@endif
