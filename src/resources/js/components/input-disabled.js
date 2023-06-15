const elements = [
    { checkboxId: '#immediate_publication_set', inputIds: ['#publication_date', '#publication_time'], disableWhenChecked: true },
    { checkboxId: '#end_publication_set', inputIds: ['#end_publication_date', '#end_publication_time'], disableWhenChecked: false }
];

window.onload = function() {
    elements.forEach(({ checkboxId, inputIds, disableWhenChecked }) => {
        const checkbox = document.querySelector(checkboxId);
        if(checkbox) {
            checkbox.addEventListener('change', () => toggleInputDisabled(checkbox, inputIds, disableWhenChecked));
            toggleInputDisabled(checkbox, inputIds, disableWhenChecked);
        }
    });
};

function toggleInputDisabled(checkbox, inputIds, disableWhenChecked) {
    inputIds.forEach(inputId => {
        const input = document.querySelector(inputId);
        if (disableWhenChecked) {
            checkbox.checked ? input.setAttribute('disabled', '') : input.removeAttribute('disabled');
        } else {
            checkbox.checked ? input.removeAttribute('disabled') : input.setAttribute('disabled', '');
        }
    });
}