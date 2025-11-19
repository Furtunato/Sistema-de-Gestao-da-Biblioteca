<?php
require_once 'biblioteca.php';
require_once 'connection.php';

class BibliotecaDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();

        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS Biblioteca (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(100) NOT NULL UNIQUE,
             autor VARCHAR(100) NOT NULL,
                ano INT NOT NULL,
                genero VARCHAR(100) NOT NULL,
                qtde INT NOT NUL
            )
        ");
    }

    public function criarBiblioteca(Biblioteca $biblioteca) {
        $stmt = $this->conn->prepare("
            INSERT INTO Biblioteca (titulo, autor, ano, genero, qtde)
            VALUE (:titulo, :autor, :ano, :genero, :qtde)
        ");
        $stmt->execute([
            'titulo' => $biblioteca->getTitulo(),
            'autor' => $biblioteca->getAutor(),
            'ano' => $biblioteca->getAno(),
            'genero' => $biblioteca->getGenero(),
            'qtde' => $biblioteca->getQtde(),
        ]);
    }
}