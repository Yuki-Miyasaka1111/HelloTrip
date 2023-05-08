@extends('layouts.client')

@section('content')
    <div class="dev-nosidebar-container">
        @foreach ($hotels as $hotel)
                <x-partials.project-card :hotel="$hotel" clickable="true" />
        @endforeach
    </div>
@endsection