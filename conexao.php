<?php
// Definição das constantes de conexão com o banco de dados
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'supermercado');

// Conexão com o banco de dados MySQL usando o objeto MySQLi
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verifica a conexão
if ($mysqli->connect_error) {
    die("Erro de conexão com o banco de dados: " . $mysqli->connect_error);
}
?>
