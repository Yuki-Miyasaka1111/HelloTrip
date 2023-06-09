@props(['class' => '', 'hotel', 'clickable' => false])

<div class="{{ $class }}">
@if (isset($clickable) && $clickable === 'true')
    <a href="{{ route('project.hotel.index', $hotel->id) }}" class="flex justify-start items-center p-2">
@else
    <div class="flex justify-start items-center bg-primary p-2">
@endif
        <div class="project_card_left mr-2">
            <img src="https://micado.jp/wp-content/uploads/2023/04/noname-2-1024x683.png" alt="{{ $hotel->name }}">
        </div>
        <div class="project_card_right">
            <b class="project_card_right-ttl">{{ $hotel->name }}</b>
            <div class="project_card_right-flex flex items-center mt-2">
            @if ($hotel->is_public)
                <p class="project_card_right-public mr-1 font-weight-bold">公開</p>
                <p class="project_card_right-public_url font-weight-bold">{{ route('hotel.show', $hotel->id) }}</p>
            @else
                <p class="project_card_right-private mr-1 font-weight-bold">非公開</p>
                <p class="project_card_right-private_url font-weight-bold">{{ route('hotel.show', $hotel->id) }}</p>
            @endif
            </div>
        </div>
@if (isset($clickable) && $clickable === 'true')
    </a>
@else
    </div>
@endif
</div>