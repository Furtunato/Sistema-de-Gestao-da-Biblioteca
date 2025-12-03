<?php

require_once __DIR__ . '/../Model/bibliotecaDAO.php';
require_once __DIR__ . '/../Model/biblioteca.php';

class BibliotecaController {
    private $dao;

    public function __construct() {
        $this->dao = new BibliotecaDAO();
    }

    // READ
    public function ler() {
        return $this->dao->lerBiblioteca();
    }

    // BUSCAR
    public function buscar($texto) {
        return $this->dao->buscarBiblioteca($texto);
    }

    // CREATE
    public function criar($titulo, $autor, $ano, $genero, $qtde) {
        $biblioteca = new Biblioteca($titulo, $autor, $ano, $genero, $qtde);
        $this->dao->criarBiblioteca($biblioteca);
    }

    // UPDATE
    public function atualizar($tituloOriginal, $novoTitulo, $autor, $ano, $genero, $qtde) {
        $this->dao->atualizarBiblioteca($tituloOriginal, $novoTitulo, $autor, $ano, $genero, $qtde);
    }

    // DELETE
    public function deletar($titulo) {
        $this->dao->excluirBiblioteca($titulo);
    }
}
