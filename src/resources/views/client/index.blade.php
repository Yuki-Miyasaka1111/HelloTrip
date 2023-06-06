@extends('layouts.client')

@section('content')
    <div class="dev-nosidebar-container">
        <div class="preview-save-button-wrap width-full bg-primary">
            <div class="p-2 d-flex items-center justify-between width-large mx-auto">
                <div class="preview-save-button-breadcrumb d-flex items-center justify-between">
                    <h3 class="preview-save-button-breadcrumb-item py-1-1-2-5">プロジェクト情報</h3>
                </div>
                <div>
                    <button id="openModalButton" class="c-primary__button px-4 py-1-1-2-5 ml-1 font-weight-bold">
                        プロジェクト新規作成
                    </button>

                    <x-popup.modal.modal_window route="project.storeProject" modalTitle="プロジェクト設定" btnTitle="プロジェクトを作成" />
                </div>
            </div>
        </div>
        @foreach ($hotels as $hotel)
                <x-partials.project-card class="width-large bg-primary mx-auto my-2" :hotel="$hotel" clickable="true" />
        @endforeach
    </div>
@endsection