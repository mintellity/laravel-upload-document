const editButtons = document.querySelectorAll('.edit-document-button');
const cancelButtons = document.querySelectorAll('.cancel-document-button');
const saveButtons = document.querySelectorAll('.save-document-button');

editButtons.forEach((editButton) => {
    editButton.addEventListener('click', (event) => {
        const tableRow = event.target.closest('tr');
        toggleEditRow(tableRow);
    });
});

cancelButtons.forEach((cancelButton) => {
    cancelButton.addEventListener('click', (event) => {
        const tableRow = event.target.closest('tr');
        toggleEditRow(tableRow);
    });
});

saveButtons.forEach((saveButton) => {
    saveButton.addEventListener('click', (event) => {
        const tableRow = event.target.closest('tr');
        toggleEditRow(tableRow);

        // Find the associated form and submit it
        const form = tableRow.querySelector('form#editDocumentForm');
        if (form) {
            form.submit();
        }
    });
});

function toggleEditRow(tableRow) {
    const documentName = tableRow.querySelector('.document-name');
    const inputField = tableRow.querySelector('input[name="name"]');
    const editButton = tableRow.querySelector('.edit-document-button');
    const saveButton = tableRow.querySelector('.save-document-button');
    const cancelButton = tableRow.querySelector('.cancel-document-button');

    documentName.classList.toggle('d-none');
    inputField.classList.toggle('d-none');
    editButton.classList.toggle('d-none');
    saveButton.classList.toggle('d-none');
    cancelButton.classList.toggle('d-none');

    inputField.focus();
}
