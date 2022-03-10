/**
 * Author: Alex Marquezini
 * Description: Script para disponibilizar um gerenciador de 
 * arquivos múltiplos para upload simples.
 */
var listFiles = $('#files').val();

$(document).ready(function () {
    addFileToFileList();
    renderFiles();
})

$('#files').change(function (event) {
    addFileToFileList();
    renderFiles();
})

function renderFiles() {
    $('#file-names').empty();

    Array.from(listFiles).forEach((file) => {
        var idBase = generateFileID(file);

        file.id = idBase;

        $('#file-names').append(
            `<p id="${idBase}" class="file">${file.name}</p>`
        );

        $('#' + idBase).click(function () {
            removeFileFromFileList(idBase);
            renderFiles();
        })
    });

    refreshFiles()
    console.log(listFiles)
}

function fileExists(name) {
    return Array.from(listFiles).filter(file => file.name === name).length > 0;
}

function addFileToFileList() {
    const dt = populateDataTransferFromFileList()
    const input = document.getElementById('files')
    const {
        files
    } = input

    for (let i = 0; i < files.length; i++) {
        const file = files[i]
        if (!fileExists(file.name))
            dt.items.add(file)
    }

    listFiles = dt.files
}

function populateDataTransferFromFileList() {
    const dt = new DataTransfer()

    for (let i = 0; i < listFiles.length; i++) {
        const file = listFiles[i]
        dt.items.add(file)
    }

    return dt;
}

function removeFileFromFileList(id) {
    const dt = new DataTransfer()

    for (let i = 0; i < listFiles.length; i++) {
        const file = listFiles[i]
        if (id !== file.id)
            dt.items.add(file)
    }

    listFiles = dt.files
}

function refreshFiles() {
    const input = document.getElementById('files')
    input.files = listFiles
}

function generateFileID(file){
    return `${file.name.replace(/[\W_]+/g,"")}-${file.size}-${file.lastModified}`;
}