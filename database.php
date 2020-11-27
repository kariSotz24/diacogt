<?php 
    $server = 'localhost';
    $database = 'u688267941_diacogt';
    $username = 'u688267941_diacogt';
    $password = 'Minnie11.';

    try {
    //Variable de conexion: Almacenar la bd
    $conn = new PDO("mysql:host=$server; dbname=$database;", $username, $password);
    } catch (PDOException $e) {
        die('Conexión fallida: ' . $e->getMessage());
    }
?>