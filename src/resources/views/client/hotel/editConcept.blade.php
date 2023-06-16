@extends('layouts.client')


@section('content')

@include('components.client.popup.success.flash-success')

@include('components.client.popup.errors.flash-error')

<form action="{{ isset($selected_hotel) ? route('project.hotel.updateConcept', $selected_hotel->id) : route('project.hotel.storeConcept') }}" method="POST" enctype="multipart/form-data" class="dev-container">
    @csrf

    @if(isset($selected_hotel))
        @method('PUT')
    @endif
    <x-client.partials.preview-save-button :links="[
        ['title' => 'ホテル情報'],
        ['title' => 'コンセプト']
    ]" />

    <x-client.partials.project-information-box title="コンセプト">
        <div class="form-group d-flex justify-start items-stretch ">
            <x-client.labels.label label="コンセプト文章" />
            <div class="p-1">
                <x-client.inputs.textarea name="concept" width="520px" height="220px" :description="$selected_hotel->concept" placeholder="コンセプトに関する説明文を入力(最大250文字)" />
            </div>
            @error('concept')
            <span class="my-1-2-5 ml-1-5 d-flex items-center" style="color:red;">コンセプトを250文字以内で入力してください</span>
            @enderror
        </div>

    </x-project-information-box>
</form>
@endsection