$(document).ready(function () {
    var fileArea = document.getElementById('dragDropArea');
    var fileInput = document.getElementById('fileInput');
    var dbImage = document.getElementById('show-db-image');
    var defaultImage = document.getElementById('default-image');

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
        fileArea.classList.remove('dragenter');
        var files = evt.dataTransfer.files;
        fileInput.files = files;
        photoPreview('onChenge',files[0]);
    });

    fileInput.addEventListener('change', function(evt){
        if (fileInput.files.length > 0) {
            photoPreview('onChange', fileInput.files[0]);
        }
    });

    function photoPreview(event, f = null) {
        var file = f;
        if(file === null){
            file = event.target.files[0];
        }
        var reader = new FileReader();
        var preview = document.getElementById("previewArea");
        var previewImage = document.getElementById("previewImage");

        if(previewImage != null) {
            preview.removeChild(previewImage);
        }
        reader.onload = function(event) {
            var img = document.createElement("img");
            img.setAttribute("src", reader.result);
            img.setAttribute("id", "previewImage");
            if ( dbImage !== null ){
                dbImage.style.display = "none";
            } else if( defaultImage !== null ){
                defaultImage.style.display = "none";
            }
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});