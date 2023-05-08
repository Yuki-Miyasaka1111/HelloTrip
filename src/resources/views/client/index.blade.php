@extends('layouts.client')

@section('content')

    @foreach ($hotels as $hotel)
        <x-partials.project-card :hotel="$hotel" clickable="true" />
    @endforeach

@endsection