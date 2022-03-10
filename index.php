<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alex Marquezini">
    <title>Envio de Múltiplos Arquivos</title>
    <style>
        .file {
            cursor: pointer;
        }

        .file:hover {
            color: red;
        }
    </style>
</head>

<body>
    <form action="send-files.php" enctype="multipart/form-data" method="post">
        <input type="file" name="files[]" id="files" multiple>
        <div id='file-names'></div>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    var listFiles = $('#files').val();

    $(document).ready(function() {
        addFileToFileList();
        renderFiles();
    })

    $('#files').change(function(event) {
        addFileToFileList();
        renderFiles();
    })

    function renderFiles() {
        $('#file-names').empty();

        Array.from(listFiles).forEach((file) => {
            var idBase = file.name.replace('.', '');

            file.id = idBase;

            $('#file-names').append(
                `<p id="${idBase}" class="file">${file.name}</p>`
            );

            $('#' + idBase).click(function() {
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
</script>