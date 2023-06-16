function addItem(addButton, cloneSource, appendAfter) {
    $(addButton).on("click", function () {
        // クローン元の要素を複製
        var clone = $(cloneSource).clone();

        // 複製した要素内のinputとselectの値を空にする
        clone.find('input, select').val("");

        // 複製した要素をappendTo要素の _後ろ_ に追加
        $(appendAfter).last().after(clone);
    });
}

function deleteItem(deleteButton) {
    $(document).on("click", deleteButton, function () {
        // クリックされた要素の親要素を削除
        $(this).closest('.form-append').remove();
    });
}
// クローンの削除
deleteItem(".js-delete-clone");

// 月定休日の追加・削除
addItem(".js-addMonthlyHoliday", '.monthly-holiday-slot:first', '.monthly-holiday-slot');
// 臨時定休日の追加・削除
addItem(".js-addTemporaryHoliday", '.temporary-holiday-slot:first', '.temporary-holiday-slot');
