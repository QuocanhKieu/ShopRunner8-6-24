
<div id="pagination-container">
{{--    $pagination === $orders, $products... instanceCollection--}}

{{--        <x-pagination-button :url="$pagination->previousPageUrl()??''" label="Previous" />--}}

    @for ($i = 1; $i <= $pagination->lastPage(); $i++)
        <x-pagination-button :url="url()->current().'?page='.$i" :label="$i" :class="$i === $pagination->currentPage()?'active':''" />
    @endfor

{{--        <x-pagination-button :url="$pagination->nextPageUrl()??''" label="Next" />--}}
</div>
