@props(['method' => 'POST', 'route' => '', 'type' => 'submit', 'modalTitle' => '', 'btnTitle' => ''])

<div id="createProjectModal" class="modal">
    <div class="modal-content">
        <form id="createProjectForm" action="{{ route( "$route" ) }}" method="{{ $method }}" enctype="multipart/form-data">
            @csrf

            <div>
                <div class="dev-container-title d-flex justify-between items-center">
                    <h4 class="px-1-5 py-1-2-5 font-weight-bold">{{ $modalTitle }}</h4>
                    <span id="closeModalButton" class="close px-1-5 py-1-2-5 cursor-pointer font-weight-bold">×</span>
                </div>
                <div class="form-group d-flex justify-start items-stretch">
                    <x-client.labels.label label="サムネイル画像" class="flex-wrap" alignItems="items-baseline"  />
                    <div class="d-flex flex-wrap">
                        <x-client.inputs.image name="thumbnail" multiple="False" />
                    </div>
                    @error('thumbnail')
                    <span style="color:red;">ホテル画像をアップロードしてください</span>
                    @enderror
                </div>

                <div class="form-group d-flex justify-start">
                    <x-client.labels.label label="タイトル" alignItems="items-center" required />
                    <div class="p-1">
                        <x-client.inputs.text name="name" width="420px" placeholder="施設名を入力(最大40文字)" />
                    </div>
                    @error('name')
                    <span class="d-flex items-center" style="color:red;">タイトルを40文字以内で入力してください</span>
                    @enderror
                </div>
            </div>
            <div class="text-center p-1">
                <button class="c-primary__button px-4 py-1-1-2-5" type="{{ $type }}">{{ $btnTitle }}</button>
            </div>
        </form>
    </div>
</div>