// import Trix from "trix"

var element = document.querySelector("trix-editor");

document.addEventListener('trix-change', function (e) {
    // 入力内容をHTMLで取得
    var html = element.innerHTML;

    // プレビューエリアにコピー
    $("#preview-area").html(html);
});