@props(['selected_hotel', 'title', 'btnTitle'])

<div class="p-1-5">
    <div class="bg-primary element-level-2">
        <div class="dev-container-title d-flex justify-between items-center">
            <h4 class="px-1-5 py-1-2-5 font-weight-bold">{{ $title }}</h4>
            <a href="{{ route('project.campaign.createCampaign', $selected_hotel->id) }}" class="c-primary__button d-block px-3 py-0-7-5 mx-1-5 font-weight-bold">{{ $btnTitle }}</a>
        </div>
        {{ $slot }}
    </div>
</div>