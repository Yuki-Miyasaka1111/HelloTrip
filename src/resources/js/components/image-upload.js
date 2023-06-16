$(document).ready(function () {
    var fileAreas = document.querySelectorAll('.upload-image-wrap');
    var fileInput = document.getElementById('fileInput');
    var activeAreaIndex = 0; // クリックまたはドロップされたエリアを追跡する変数

    var images = [];

    fileAreas.forEach(function(fileArea) {
        fileArea.addEventListener('dragover', function(evt){
            evt.preventDefault();
            fileArea.classList.add('dragover');
        });

        fileArea.addEventListener('dragleave', function(evt){
            evt.preventDefault();
            fileArea.classList.remove('dragover');
        });

        fileArea.addEventListener('drop', function(evt){
            evt.preventDefault();
            fileArea.classList.remove('dragover');
            activeAreaIndex = evt.currentTarget.dataset.index; // ドロップされたエリアのインデックスを保存
            var items = evt.dataTransfer.items; // ドロップされたアイテムを取得
            for (var i = 0; i < items.length; i++) {
                if (items[i].kind === 'file') {
                    var file = items[i].getAsFile();
                    if (parseInt(activeAreaIndex) - 1 + i < fileAreas.length) {
                        var targetArea = fileAreas[parseInt(activeAreaIndex) - 1 + i];
                        photoPreview(targetArea, file);
                    }
                }
            }
            fileInput.files = evt.dataTransfer.files; // 新しいファイルリストを input 要素に関連付け
        });

        fileArea.addEventListener('click', function(evt){
            activeAreaIndex = evt.currentTarget.dataset.index; // クリックされたエリアのインデックスを保存
        });
    });

    if(fileInput) {
        fileInput.addEventListener('change', function(evt){
            var files = Array.from(fileInput.files);
            if (files.length > 0) {
                files.forEach(function(file, index) {
                    var targetIndex = parseInt(activeAreaIndex) + index;
                    if (targetIndex <= fileAreas.length) {
                        photoPreview(fileAreas[targetIndex - 1], file); // インデックスは0ベースなので-1
                        images.push(file);
                    }
                });
            }
        });
    }

    function photoPreview(fileArea, file) {
        var reader = new FileReader();
        var preview = fileArea.querySelector(".upload-image-zone");
        var previewImage = fileArea.querySelector(".previewImage");
        var dbImage = fileArea.querySelector(".show-db-image");
        var defaultImage = fileArea.querySelector(".default-image");
    
        if(previewImage != null) {
            preview.removeChild(previewImage);
        }
        reader.onload = function(event) {
            var img = document.createElement("img");
            img.setAttribute("src", reader.result);
            img.setAttribute("class", "previewImage");
            if (dbImage !== null) {
                dbImage.style.display = "none";
            } else if(defaultImage !== null) {
                defaultImage.style.display = "none";
            }
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});