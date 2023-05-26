@extends('layouts.client')

@section('content')
    <div class="dev-container">
        <x-partials.preview-save-button :links="[
                ['title' => 'ダッシュボード']
            ]" 
            :btn="false"
        />

        <x-partials.project-card class="width-full p-1-5" :hotel="$selected_hotel" clickable="false" />
    </div>
@endsection