<label class="upload-image-wrap m-1-5">
    <input type="file" name="images[]" multiple class="d-none input-image">
    <div class="upload-image-zone d-flex flex-wrap text-center">
        <img src="" class="drop-image show-drop-image" alt="jsから来た画像">
        <img src="{{ $imageUrl ?? '' }}" alt="プロフィール画像" class="show-db-image">
        <img src="{{ asset('img/icons/c-image_icon.svg') }}" alt="クリックしてファイルを選択または、ここに画像ファイルをドラッグ&ドロップ" class="default-image">
    </div>
</label>