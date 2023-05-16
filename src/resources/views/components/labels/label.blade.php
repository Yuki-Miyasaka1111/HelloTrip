<div class="form-label py-1-2-5 px-1">
    <div class="d-flex items-center justify-between">
        <h6 class="form-label-title">{{ $label }}</h6>
        @if(isset($required))
            <span class="form-label-required d-inline-block ">必須</span>
        @endif
    </div>
</div>