<?php 
    require 'partials/db.php';

    $querydep = mysqli_query($conn, "SELECT * FROM departamento");
    $querymun = mysqli_query($conn, "SELECT * FROM municipio");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Queja</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php'?>
    <div class="nqueja">
    
    <form action="nqueja.php" method="POST">
    <?php
    require 'database.php';
        $message="";
        $sql = "INSERT INTO queja (id_queja, nom_comercio, desc_queja, fecha_queja, email_respuesta, id_municipio) 
                 VALUES          (:id_queja, :nom_comercio, :desc_queja, :fecha_queja, :email_respuesta, :id_municipio )";
        //prepare: ejecuta una consulta SQL
        $reg = $conn->prepare($sql);
        //bindParam: Vincula parametros
        $reg->bindParam(':id_queja', $_POST['id_queja']);
        $reg->bindParam(':nom_comercio', $_POST['nom_comercio']);
        $reg->bindParam(':desc_queja', $_POST['desc_queja']);
        $reg->bindParam(':fecha_queja', $_POST['fecha_queja']);
        $reg->bindParam(':email_respuesta', $_POST['email_respuesta']);
        $reg->bindParam(':id_municipio', $_POST['id_municipio']);
        
        if ($reg->execute()) {
          $message = 'Queja agregada correctamente';
        } else {
          $message = '';
        }
    ?>

    <div>
        <!----------------Comercio-------------------->
        <br><div class="col-md-3 mb-3 align-center">
            <label>Comercio: </label>
            <input class="form-control" id="validationDefault03" name="nom_comercio" placeholder="Escriba título" required> 
        </div>
        <!---------------Departamento------------------------------------>
        <br><div class="col-md-3 mb-3">
        <label>Departamento: </label>
        <select class="custom-select" style="width: 300px" name="id_depto" required>
        <?php 
        while($datosdepto = mysqli_fetch_array($querydep)){ ?>
            <option class="form-control" value="<?php echo $datosdepto['id_depto']?>"> <?php echo $datosdepto['nom_depto'] ?></option>
        <?php } ?>
        </select>
        </div>
        <!---------------Municipio------------------------------------>
        <br><div class="col-md-3 mb-3">
        <label>Municipio: </label>
        <select class="custom-select" style="width: 300px" name="id_municipio" required>
        <?php 
        while($datosmuni = mysqli_fetch_array($querymun)){ ?>
            <option class="form-control" value="<?php echo $datosmuni['id_municipio']?>"> <?php echo $datosmuni['nom_municipio'] ?></option>
        <?php } ?>
        </select>
        </div>
        <!-------------Descripcion de la queja --------------------------------->
        <label>Queja: </label>
        <div class="col-md-3 mb-3">
            <label></label>
            <input class="form-control" id="validationDefault03" name="desc_queja" placeholder="Escriba queja" required> 
        </div>
        <!-------------------------------------------------------------->
        <label>Fecha: </label>
        <br><div class="col-md-3 mb-3">
            <input class="form-control" type="date" name="fecha_queja" placeholder="Escriba fecha">
        </div>
        <!-------------------------------------------------------------->
        <label>Email (*opcional): </label>
        <br><div class="col-md-3 mb-3">
            <input class="form-control" id="validationDefault03" name="email_respuesta" placeholder="Escriba email">
            <label>(Si desea que le demos seguimiento por favor ingrese su correo.)</label>
        </div>
        <!-------------------------------------------------------------->
        <br>   
        <input type="submit" value="Agregar">
        </div>
        <?php if(!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
    </form>
    </div>
</body>
</html>


<!--  
    insertar id_municipio a comercial
    insertar id_comercial a quejas
    insertar datos a queja 
-->