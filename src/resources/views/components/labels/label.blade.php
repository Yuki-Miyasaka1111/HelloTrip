@props(['class' => '', 'alignItems' => '', 'label' => ''])
<div class="form-label d-flex justify-between {{ $class }} {{ $alignItems }} py-1-2-5 px-1">
    <h6 class="form-label-title">{{ $label }}</h6>
    @if(isset($attributes['required']))
        <span class="form-label-required d-inline-block ">必須</span>
    @endif
</div>