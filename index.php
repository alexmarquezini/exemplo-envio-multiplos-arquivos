<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Alex Marquezini">
    <title>Envio de Múltiplos Arquivos</title>
    <link rel="stylesheet" href="css/multi-files.css">
</head>

<body>
    <form action="files/sended.php" enctype="multipart/form-data" method="post">
        <input type="file" name="files[]" id="files" multiple>
        <div id='file-names'></div>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="js/multi-files.js"></script>
