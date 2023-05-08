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
            handleFiles(files, $showDropImage, $showDbImage, $defaultImage, $inputFile);
        });

        // Click to select image
        $dropArea.on("click", function () {
            $inputFile.click();
        });

        // Input change event handler
        $inputFile.on("change", function (event) {
            var files = event.target.files;
            handleFiles(files, $showDropImage, $showDbImage, $defaultImage, $inputFile);
        });
    }

    function handleFiles(files, $showDropImage, $showDbImage, $defaultImage, $inputFile) {
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

    function updateImageVisibility($dropArea) {
        var $showDropImage = $dropArea.find(".show-drop-image");
        var $showDbImage = $dropArea.find(".show-db-image");
        var $defaultImage = $dropArea.find(".default-image");

        if ($showDropImage.attr("src")) {
            $showDropImage.show();
            $showDbImage.hide();
            $defaultImage.hide();
        } else if ($showDbImage.attr("src")) {
            $showDbImage.show();
            $defaultImage.hide();
        } else {
            $defaultImage.show();
        }
    }

    // Initialize drop zones
    $(".upload-image-zone").each(function () {
        var $dropArea = $(this);
        initializeDropZone($dropArea);
        updateImageVisibility($dropArea);
    });

});
