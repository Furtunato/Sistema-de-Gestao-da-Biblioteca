<?php
// Código atualizado com funcionalidade de busca integrada
require_once __DIR__ . '/../Controller/bibliotecaController.php';

$controller = new BibliotecaController();

// --- BUSCAR ---
$busca = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

if ($busca !== '') {
    $lista = $controller->buscar($busca);
} else {
    $lista = $controller->ler();
}

// --- CRIAR ---
if (isset($_POST['criar'])) {
    $controller->criar(
        $_POST['titulo'],
        $_POST['autor'],
        $_POST['ano'],
        $_POST['genero'],
        $_POST['qtde']
    );

    header("Location: index.php");
    exit;
}

// --- ATUALIZAR ---
if (isset($_POST['atualizar'])) {
    $controller->atualizar(
        $_POST['tituloOriginal'],
        $_POST['novoTitulo'],
        $_POST['autor'],
        $_POST['ano'],
        $_POST['genero'],
        $_POST['qtde']
    );

    header("Location: index.php");
    exit;
}

// --- DELETAR ---
if (isset($_GET['delete'])) {
    $controller->deletar($_GET['delete']);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Biblioteca - CRUD</title>
</head>
<body>

<h1>Gerenciamento de Biblioteca</h1>

<!-- BUSCA -->
<form method="GET">
    <input type="text" name="buscar" placeholder="Buscar por título ou autor" value="<?= $busca ?>">
    <button type="submit">Buscar</button>
</form>

<!-- FORMULÁRIO DE CRIAÇÃO -->
<form method="POST">
    <h2>Cadastrar Livro</h2>

    <input type="text" name="titulo" placeholder="Título" required>
    <input type="text" name="autor" placeholder="Autor" required>
    <input type="number" name="ano" placeholder="Ano" required>
    <input type="text" name="genero" placeholder="Gênero" required>
    <input type="number" name="qtde" placeholder="Quantidade" required>

    <button type="submit" name="criar">Cadastrar</button>
</form>

<!-- LISTAGEM -->
<h2>Lista de Livros</h2>
<table>
    <tr>
        <th>Título</th>
        <th>Autor</th>
        <th>Ano</th>
        <th>Gênero</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($lista as $livro): ?>
        <tr>
            <td><?= $livro->getTitulo() ?></td>
            <td><?= $livro->getAutor() ?></td>
            <td><?= $livro->getAno() ?></td>
            <td><?= $livro->getGenero() ?></td>
            <td><?= $livro->getQtde() ?></td>

            <td>
                <a href="#" onclick="abrirModal('<?= $livro->getTitulo() ?>', '<?= $livro->getAutor() ?>', '<?= $livro->getAno() ?>', '<?= $livro->getGenero() ?>', '<?= $livro->getQtde() ?>')">Editar</a>
                <a href="?delete=<?= $livro->getTitulo() ?>" onclick="return confirm('Deseja excluir este livro?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

<!-- MODAL DE EDIÇÃO -->
<div id="modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="fecharModal()">&times;</span>

        <h2>Editar Livro</h2>

        <form method="POST">
            <input type="hidden" name="tituloOriginal" id="tituloOriginal">

            <input type="text" name="novoTitulo" id="novoTitulo" required>
            <input type="text" name="autor" id="autor" required>
            <input type="number" name="ano" id="ano" required>
            <input type="text" name="genero" id="genero" required>
            <input type="number" name="qtde" id="qtde" required>

            <button type="submit" name="atualizar">Salvar Alterações</button>
        </form>
    </div>
</div>

<script>
function abrirModal(titulo, autor, ano, genero, qtde) {
    document.getElementById("modal").style.display = "block";
    document.getElementById("tituloOriginal").value = titulo;
    document.getElementById("novoTitulo").value = titulo;
    document.getElementById("autor").value = autor;
    document.getElementById("ano").value = ano;
    document.getElementById("genero").value = genero;
    document.getElementById("qtde").value = qtde;
}

function fecharModal() {
    document.getElementById("modal").style.display = "none";
}
</script>

</body>
</html>
