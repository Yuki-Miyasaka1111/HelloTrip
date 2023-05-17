@extends('layouts.client')

@section('content')
    <div class="dev-container">
        <x-partials.project-card :hotel="$selected_hotel" clickable="false" />
    </div>
@endsection