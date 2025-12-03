<?php
require_once 'biblioteca.php';
require_once 'connection.php';

class BibliotecaDAO {
    private $conn;

    public function __construct() {
        $this->conn = Connection::getInstance();

        // Cria tabela caso não exista
        $this->conn->exec("
            CREATE TABLE IF NOT EXISTS biblioteca (
                id INT AUTO_INCREMENT PRIMARY KEY,
                titulo VARCHAR(100) NOT NULL UNIQUE,
                autor VARCHAR(100) NOT NULL,
                ano INT NOT NULL,
                genero VARCHAR(100) NOT NULL,
                qtde INT NOT NULL
            )
        ");
    }

    // CREATE
    public function criarBiblioteca(Biblioteca $biblioteca) {
        $stmt = $this->conn->prepare("
            INSERT INTO biblioteca (titulo, autor, ano, genero, qtde)
            VALUES (:titulo, :autor, :ano, :genero, :qtde)
        ");

        $stmt->execute([
            ':titulo' => $biblioteca->getTitulo(),
            ':autor'  => $biblioteca->getAutor(),
            ':ano'    => $biblioteca->getAno(),
            ':genero' => $biblioteca->getGenero(),
            ':qtde'   => $biblioteca->getQtde()
        ]);
    }

    // READ
    public function lerBiblioteca() {
        $stmt = $this->conn->query("SELECT * FROM biblioteca ORDER BY titulo");
        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Biblioteca(
                $row['titulo'],
                $row['autor'],
                $row['ano'],
                $row['genero'],
                $row['qtde']
            );
        }
        return $result;
    }

    // BUSCAR
    public function buscarBiblioteca($texto) {
        $stmt = $this->conn->prepare("
            SELECT * FROM biblioteca 
            WHERE titulo LIKE :txt 
               OR autor LIKE :txt 
               OR genero LIKE :txt
            ORDER BY titulo
        ");

        $stmt->execute([
            ':txt' => "%$texto%"
        ]);

        $result = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Biblioteca(
                $row['titulo'],
                $row['autor'],
                $row['ano'],
                $row['genero'],
                $row['qtde']
            );
        }

        return $result;
    }

    // UPDATE
    public function atualizarBiblioteca($tituloOriginal, $novoTitulo, $autor, $ano, $genero, $qtde) {
        $stmt = $this->conn->prepare("
            UPDATE biblioteca
            SET titulo = :novoTitulo, autor = :autor, ano = :ano, genero = :genero, qtde = :qtde
            WHERE titulo = :tituloOriginal
        ");

        $stmt->execute([
            ':novoTitulo'     => $novoTitulo,
            ':autor'          => $autor,
            ':ano'            => $ano,
            ':genero'         => $genero,
            ':qtde'           => $qtde,
            ':tituloOriginal' => $tituloOriginal
        ]);
    }

    // DELETE
    public function excluirBiblioteca($titulo) {
        $stmt = $this->conn->prepare("DELETE FROM biblioteca WHERE titulo = :titulo");
        $stmt->execute([':titulo' => $titulo]);
    }

    // BUSCAR
    public function buscarPorTitulo($titulo) {
        $stmt = $this->conn->prepare("SELECT * FROM biblioteca WHERE titulo = :titulo LIMIT 1");
        $stmt->execute([':titulo' => $titulo]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Biblioteca(
                $row['titulo'],
                $row['autor'],
                $row['ano'],
                $row['genero'],
                $row['qtde']
            );
        }
        return null;
    }
}
