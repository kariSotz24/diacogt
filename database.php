<?php 
    $server = 'sql214.main-hosting.eu';
    $username = 'u688267941_diacogt';
    $password = 'Minnie14.';
    $database = 'u688267941_diacogt';

    try {
    //Variable de conexion: Almacenar la bd
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
    } catch (PDOException $e) {
        die('Conexión fallida: ' . $e->getMessage());
    }
?>