<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/productos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Paquetes</title>
</head>
<body>
    <header>
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt="logo del sistenma" class="logo"></a>
    </header>
    <div class="table-container">
    <h1>Gestión de paquetes en tránsito</h1>
        <table class="table">

            <tr>
                <th>id</th>
                <th>Peso</th>
                <th>Tipo</th>
                <th>Cliente</th>
                <th>Destino</th>
                <th>Fecha de registro</th>
                <th>Estado</th>
                <th>Editar o Eliminar</th>
            </tr>
    <?php
    require('db.php');
    $sentencia="SELECT * FROM `paquete`";
    $filas=$conn->query($sentencia);    
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){ ?>
            <tr>
                <td><?php echo $fila['IdPaquete'];?></td>
                <td><?php echo $fila['Peso'];?></td>
                <td><?php echo $fila['Tipo'];?></td>
                <td><?php echo $fila['Cliente'];?></td>
                <td><?php echo $fila['Ubicacion']?></td>
                <td><?php echo $fila['FechaRegistro']?></td>
                <td><?php echo $fila['Estado']?></td>
                <td>
                    <div class="container-imagenes">
                        <a href="edicionPaqueteA.php?id=<?php echo $fila["IdPaquete"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                        <a href="deletePaqueteA.php?id=<?php echo $fila["IdPaquete"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
                    </div>
                </td>
            </tr>    
        <?php
    };
?>  
     </div>  
        </table>
        <div class="botones-container">
            <a href="agregarPaqueteA.php" class="boton">Agregar</a>   
            <a href="../HTML/admin.html" class="boton">Volver</a>
        </div>
<script src="../JS/confirmacionPaquete.js"></script>
</body>
</html>