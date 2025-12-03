<?php

class Connection {

    private static $instance = null;

    public static function getInstance() {
        
        if (!self::$instance) {
            try {
                // AJUSTE SEU USUÁRIO E SENHA AQUI:
                $host = 'localhost';
                $dbname = 'biblioteca'; // Banco de dados usado pelo sistema
                $user = 'root';
                $pass = '0719';

                // CONEXÃO COM MYSQL
                self::$instance = new PDO(
                    "mysql:host=$host;dbname=$dbname;charset=utf8",
                    $user,
                    $pass
                );

                // Modo de erro
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Erro ao conectar ao MySQL: " . $e->getMessage());
            }
        }

        return self::$instance;
    }
}

?>