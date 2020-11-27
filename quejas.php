<?php require 'partials/db.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quejas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require './partials/header.php'?>

    <?php 
    if ($conn) {
	$consulta ="SELECT Q.id_queja, Q.nom_comercio, Q.desc_queja, Q.fecha_queja,
                       M.nom_municipio,
                       D.nom_depto,
					   R.nom_region
                FROM queja Q 
                INNER JOIN municipio M    on Q.id_municipio = M.id_municipio
                INNER JOIN departamento D on M.id_depto = D.id_depto
				INNER JOIN region R 	  on D.id_region = R.id_region
                ";
    
    $resultado = mysqli_query($conn,$consulta);
	if ($resultado) {
		while ($row = $resultado->fetch_array()) {
		$nom_comercio = $row['nom_comercio'];
	    $desc_queja = $row['desc_queja'];
        $fecha_queja = $row['fecha_queja'];
        $nom_municipio = $row['nom_municipio'];
	    $nom_depto = $row['nom_depto']; 
	    $nom_region = $row['nom_region']; 
		?>
		<div class="alert alert-success" role="alert">
        	<h2></h2>
        	<div id="divquejas">
        		<p>
					<strong>Comercio: </strong>
						<?php echo $nom_comercio ?><br>
						<strong>Municipio: </strong>
						<?php echo $nom_municipio ?><br>
						<b>Queja: </b> <?php echo $desc_queja; ?> <br>
						<b>Fecha: </b> <?php echo $fecha_queja ?><br>
						<b>Departamento: </b> <?php echo $nom_depto ?><br>
						<b>Región: </b> <?php echo $nom_region?><br>
				</p>
			</div>
		</div> 
			<?php
	    }
	}
}
?>
</body>
</html>