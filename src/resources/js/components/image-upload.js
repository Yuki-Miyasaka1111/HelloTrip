$(document).ready(function () {

    function initializeDropZone($dropArea) {
        var $inputFile = $dropArea.find(".input-image");
        var $showDropImage = $dropArea.find(".show-drop-image");
        var $showDbImage = $dropArea.find(".show-db-image");
        var $defaultImage = $dropArea.find(".default-image");

        // Drag & Drop event handlers
        $dropArea.on("dragover", function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).addClass("dragging");
        });

        $dropArea.on("dragleave", function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).removeClass("dragging");
        });

        $dropArea.on("drop", function (event) {
            event.preventDefault();
            event.stopPropagation();
            $(this).removeClass("dragging");
            var files = event.originalEvent.dataTransfer.files;
            handleFiles(files, $showDropImage, $showDbImage, $defaultImage);
        });

        // Click to select image
        $dropArea.on("click", function () {
            $inputFile.click();
        });

        // Input change event handler
        // $inputFile.on("change", function (event) {
        //     var files = event.target.files;
        //     handleFiles(files, $showDropImage, $showDbImage, $defaultImage);
        
        $(document).ready(function () {
            $('.input-image').on('change', function () {
                var reader = new FileReader();
        
                reader.onload = function (e) {
                    var $showDropImage = $('.show-drop-image');
                    $showDropImage.attr('src', e.target.result);
                    $showDbImage.hide();
                    $defaultImage.hide();
                };
        
                reader.readAsDataURL(this.files[0]);
            });
        });
    }

    function handleFiles(files, $showDropImage, $showDbImage, $defaultImage) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.startsWith("image/")) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (file) {
                return function (e) {
                    $showDropImage.attr("src", e.target.result).show();
                    $showDbImage.hide();
                    $defaultImage.hide();
                };
            })(file);
            reader.readAsDataURL(file);
        }
    }

    // Initialize drop zones
    $(".upload-image-zone").each(function () {
        var $dropArea = $(this);
        initializeDropZone($dropArea);
    });

});
