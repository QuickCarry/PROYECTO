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
        <div class="logo">
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
        </div>
    </header>
    <h1> Paquetes</h1><br>
    <div class="table-container">
        <table class="table">
            <tr>
                <th>id Paquete</th>
                <th>Peso</th>
                <th>Tipo</th>
                <th>Cliente</th>
                <th>Destino</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Editar o borrar</th>
            </tr>
    <?php
    require('db.php');
    $sentencia = "SELECT * from `paquete`";
    $filas = $conn->query($sentencia);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { ?>
                <tr>
                    <td><?php echo $fila['IdPaquete']; ?></td>
                    <td><?php echo $fila['Peso']; ?></td>
                    <td><?php echo $fila['Tipo']; ?></td>
                    <td><?php echo $fila['Cliente']; ?></td>
                    <td><?php echo $fila['Ubicacion']; ?></td>
                    <td><?php echo $fila['FechaRegistro'];?></td>
                    <td><?php echo $fila['Estado'];?></td>
                    <div class="container-imagenes">
                        <td>
                            <a href="edicionPaqueteF.php?id=<?php echo $fila["IdPaquete"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                            <a href="deletePaqueteF.php?id=<?php echo $fila["IdPaquete"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
                        </td>
                    </div>
                </tr>   
    <?php
    };
?>
    </div>
    </table>
    <div class="botones-container">
        <a href="../HTML/funcionario.html" class="boton">Volver</a>
    </div>
    <script src="../JS/confirmacionPaquete.js"></script>
</body>

</html>