<?php
require_once __DIR__ . '/../Controller/bibliotecaController.php';

$controller = new bibliotecaController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->criar($_POST['titulo'], $_POST['autor'], $_POST['ano'], $_POST['genero'], $_POST['qtde']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Livro</title>
</head>
<body>

<h1>Cadastrar Livro</h1>

<form method="POST">
    <label>Título:</label><br>
    <input type="text" name="titulo" required><br><br>

    <label>Autor:</label><br>
    <input type="text" name="autor" required><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" required><br><br>

    <label>Gênero:</label><br>
    <input type="text" name="genero" required><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="qtde" required><br><br>

    <button type="submit">Cadastrar</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>
