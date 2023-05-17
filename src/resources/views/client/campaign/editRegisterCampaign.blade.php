@extends('layouts.client')


@section('content')

@include('components.popup.success.flash-success')

@include('components.popup.errors.flash-error')

<form action="{{ isset($selected_hotel) ? route('project.hotel.updateConcept', $selected_hotel->id) : route('project.hotel.storeConcept') }}" method="POST" enctype="multipart/form-data">
    <x-partials.preview-save-button :links="[
        ['title' => 'ホテル情報'],
        ['title' => 'コンセプト']
    ]" />

    <x-partials.project-information-box title="コンセプト">
        @csrf

        @if(isset($selected_hotel))
            @method('PUT')
        @endif

        <div class="form-group d-flex justify-start items-stretch ">
            <x-labels.label label="コンセプト文章" />
            <div class="p-1">
                <x-inputs.textarea name="concept" width="520px" height="220px" :description="$selected_hotel->concept" placeholder="コンセプトに関する説明文を入力(最大250文字)" />
            </div>
            @error('concept')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">コンセプトを250文字以内で入力してください</span>
            @enderror
        </div>

    </x-project-information-box>
</form>
@endsection