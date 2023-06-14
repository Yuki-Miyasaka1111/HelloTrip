@extends('layouts.client')

@section('content')
    <div class="dev-container">
        <x-client.partials.preview-save-button :links="[
                ['title' => 'ダッシュボード']
            ]" 
            :btn="false"
        />

        <div class="d-flex justify-between p-1-5">
            <x-client.partials.project-card class="dashboard_project_card" :hotel="$selected_hotel" clickable="false" />
            <x-client.partials.project-dashboard-publication class="dashboard_publication" :hotel="$selected_hotel" />
        </div>
    </div>
@endsection