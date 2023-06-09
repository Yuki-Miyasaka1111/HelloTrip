@extends('layouts.client')


@section('content')


@include('components.client.popup.success.flash-success')

@include('components.client.popup.errors.flash-error')


<form action="{{ isset($selected_hotel) ? route('project.hotel.updateFacilities', $selected_hotel->id) : route('project.hotel.storeFacilities') }}" method="POST" enctype="multipart/form-data" class="dev-container">
    @csrf

    @if(isset($selected_hotel))
        @method('PUT')
    @endif
    <x-client.partials.preview-save-button :links="[
        ['title' => 'ホテル情報'],
        ['title' => '設備']
    ]" />

    <x-client.partials.project-information-box title="設備">
        <div class="form-group d-flex justify-start ">
            <x-client.labels.label label="施設設備" />
            <div class="d-flex flex-wrap">
                @foreach ($facilities as $facility)
                    <x-inputs.checkbox name="facilities[]" :value="$facility->id" :label="$facility->name" id="facility-{{ $facility->id }}" :checked="in_array($facility->id, old('facilities', $selected_facilities))" width="50%" />
                @endforeach
            </div>
        </div>

        <div class="form-group d-flex justify-start ">
            <x-client.labels.label label="客室設備・備品" />
            <div class="d-flex flex-wrap">
                @foreach ($amenities as $amenity)
                    <x-inputs.checkbox name="amenities[]" :value="$amenity->id" :label="$amenity->name" id="amenity-{{ $amenity->id }}" :checked="in_array($amenity->id, old('amenities', $selected_amenities))" width="50%" />
                @endforeach
            </div>
        </div>
    </x-project-information-box>
</form>
@endsection