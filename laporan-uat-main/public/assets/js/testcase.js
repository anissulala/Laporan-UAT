let prakondisiCount = 1;
let tahapTestingCount = 1;

function addPrakondisiCreate() {
    prakondisiCount++;
    const container = document.getElementById('prakondisi-container');
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2');
    inputGroup.innerHTML = `
        <span class="input-group-text"><i class="bi bi-grip-vertical"></i></span>
        <input type="text" class="form-control" name="prakondisi[]" placeholder="Prakondisi ${prakondisiCount}">
        <span class="input-group-text"><i class="bi bi-trash3-fill" onclick="removeElement(this)"></i></span>
    `;
    container.appendChild(inputGroup);
}

function addTahapTestingCreate() {
    tahapTestingCount++;
    const container = document.getElementById('tahap-testing-container');
    const inputGroup = document.createElement('div');
    inputGroup.classList.add('input-group', 'mb-2');
    inputGroup.innerHTML = `
        <span class="input-group-text"><i class="bi bi-grip-vertical"></i></span>
        <input type="text" class="form-control" name="tahap_testing[]" placeholder="Tahap Testing ${tahapTestingCount}">
        <span class="input-group-text"><i class="bi bi-trash3-fill" onclick="removeElement(this)"></i></span>
    `;
    container.appendChild(inputGroup);
}

function removeElement(element) {
    element.closest('.input-group').remove();
}
//Field EDIT
// Pastikan untuk memeriksa apakah kontainer ada sebelum menambah
function addPrakondisiEdit(modalId) {
    const container = document.getElementById(`prakondisi-container-${modalId}`);
    if (container) {
        const newElement = document.createElement('div');
        newElement.className = 'input-group mb-2';
        newElement.innerHTML = `
            <span class="input-group-text"><i class="bi bi-grip-vertical"></i></span>
            <input type="text" class="form-control" name="prakondisi[]" placeholder="Prakondisi">
            <span class="input-group-text"><i class="bi bi-trash3-fill" onclick="removeElement(this)"></i></span>
        `;
        container.appendChild(newElement);
    } else {
        console.error(`Container for prakondisi with id ${modalId} not found.`);
    }
}

function addTahapTestingEdit(modalId) {
    const container = document.getElementById(`tahap-testing-container-${modalId}`);
    if (container) {
        const newElement = document.createElement('div');
        newElement.className = 'input-group mb-2';
        newElement.innerHTML = `
            <span class="input-group-text"><i class="bi bi-grip-vertical"></i></span>
            <input type="text" class="form-control" name="tahap_testing[]" placeholder="Tahap Testing">
            <span class="input-group-text"><i class="bi bi-trash3-fill" onclick="removeElement(this)"></i></span>
        `;
        container.appendChild(newElement);
    } else {
        console.error(`Container for tahap testing with id ${modalId} not found.`);
    }
}