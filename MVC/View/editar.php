<?php
require_once __DIR__ . '/../Controller/bibliotecaController.php';

$controller = new bibliotecaController();

// buscar livro pelo título (GET)
$livro = $controller->dao->buscarPorTitulo($_GET['titulo']);

if (!$livro) {
    echo "Livro não encontrado!";
    exit;
}

$tituloOriginal = $livro->getTitulo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->atualizar(
        $tituloOriginal,
        $_POST['titulo'],
        $_POST['autor'],
        $_POST['ano'],
        $_POST['genero'],
        $_POST['qtde']
    );

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Livro</title>
</head>
<body>

<h1>Editar Livro</h1>

<form method="POST">
    <label>Título:</label><br>
    <input type="text" name="titulo" value="<?= $livro->getTitulo(); ?>" required><br><br>

    <label>Autor:</label><br>
    <input type="text" name="autor" value="<?= $livro->getAutor(); ?>" required><br><br>

    <label>Ano:</label><br>
    <input type="number" name="ano" value="<?= $livro->getAno(); ?>" required><br><br>

    <label>Gênero:</label><br>
    <input type="text" name="genero" value="<?= $livro->getGenero(); ?>" required><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="qtde" value="<?= $livro->getQtde(); ?>" required><br><br>

    <button type="submit">Salvar Alterações</button>
</form>

<br>
<a href="index.php">Voltar</a>

</body>
</html>
