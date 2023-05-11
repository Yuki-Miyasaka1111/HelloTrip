@extends('layouts.client')


@section('content')

@if (session('success'))
    @include('components.popup.success.flash-success')
@endif

@if ($errors->any())
    @include('components.popup.errors.flash-error')
@endif

<form action="{{ isset($selected_hotel) ? route('project.hotel.updateFacilities', $selected_hotel->id) : route('project.hotel.storeFacilities') }}" method="POST" enctype="multipart/form-data">
    <x-partials.preview-save-button :links="[
        ['title' => 'ホテル情報'],
        ['title' => '設備']
    ]" />

    <x-partials.project-information-box title="設備">
        @csrf

        @if(isset($selected_hotel))
            @method('PUT')
        @endif

        <div class="form-group d-flex justify-start ">
            <x-labels.label label="施設設備" />
            <div class="d-flex flex-wrap">
                @foreach ($facilities as $facility)
                    <x-inputs.checkbox name="facilities[]" :value="$facility->id" :label="$facility->name" :checked="in_array($facility->id, old('facilities', []))" width="50%" />
                @endforeach
            </div>
            @error('name')
            <span style="color:red;">ホテル名を20文字以内で入力してください</span>
            @enderror
        </div>
    </x-project-information-box>
</form>
@endsection