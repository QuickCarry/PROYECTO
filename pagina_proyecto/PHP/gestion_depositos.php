<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/depositos.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Productos</title>
</head>
<body>
    <header>
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo"></a>
    </header>
    <h1>Gestion de depositos</h1>
    <div class="table-container">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Departamento</th>
                <th>Ruta</th>
                
                <th>Editar o Eliminar</th>
            </tr>
    
    <?php
    require('db.php');
    $sentencia="SELECT * from `almacenescarry`";
    $filas=$conn->query($sentencia);    
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){ ?>
            <tr>
                <td><?php echo $fila['IDCarry'];?></td>
                <td><?php echo $fila['Departamento']; ?></td>
                <td><?php echo $fila['Ruta'];?></td>
                <td>
                    <div class="container-imagenes">
                        <a href="edicionDeposito.php?id=<?php echo $fila["IDCarry"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                        <a href="deleteDeposito.php?id=<?php echo $fila["IDCarry"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
                    </div>
                </td>
            </tr>
        <?php
    };
?>  
        </table>
    </div> 
    <div class="botones-container">
        <a href="agregarDeposito.php" class="boton">Agregar</a>
        <a href="../HTML/admin.html" class="boton">Volver</a>
    </div>
<script src="../JS/confirmacionDeposito.js"></script>
</body>
</html>