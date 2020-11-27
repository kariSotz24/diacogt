<?php 
    $server = '194.5.156.43';
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