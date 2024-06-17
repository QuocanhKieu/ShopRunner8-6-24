@props(['url' => '', 'label'])
<button data-url="{{ $url }}" type="button" {{$attributes->merge(['class'=>'btn btn-primary mb-4'])}}>
    {{ $label }}
</button>
<!-- resources/views/components/pagination-button.blade.php -->

