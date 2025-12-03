<?php

class Biblioteca {
    private $titulo;
    private $autor;
    private $ano;
    private $genero;
    private $qtde;

    public function __construct($titulo, $autor, $ano, $genero, $qtde) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->ano = $ano;
        $this->genero = $genero;
        $this->qtde = $qtde;
    }

    // GETTERS
    public function getTitulo() {
        return $this->titulo;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function getAno() {
        return $this->ano;
    }

    public function getGenero() {
        return $this->genero;
    }

    public function getQtde() {
        return $this->qtde;
    }

    // SETTERS
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function setGenero($genero) {
        $this->genero = $genero;
    }

    public function setQtde($qtde) {
        $this->qtde = $qtde;
    }
}
