<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/usuarios.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Choferes</title>
</head>
<body>
    <header>
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo"></a>
    </header>
    <h1>Gestion de choferes</h1>
    <div class="table-container">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Horarios</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Cargo</th>
                <th>Editar o Eliminar</th>
            </tr>
    
    <?php
    require('db.php');
    $sentencia="SELECT * FROM `chofer`";
    $filas=$conn->query($sentencia);    
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){ ?>
            <tr>
                <td><?php echo $fila['Ci'];?></td>
                <td><?php echo $fila['NombreCompleto'];?></td>
                <td><?php echo $fila['Horarios'];?></td>
                <td><?php echo $fila['correo'];?></td>
                <td><?php echo $fila['contraseña'];?></td>
                <td><?php echo $fila['cargo'];?></td>
                <td>
                    <div class="container-imagenes">
                        <a href="../PHP/edicionChofer.php?id=<?php echo $fila["Ci"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                        <a href="deleteChofer.php?id=<?php echo $fila["Ci"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
                    </div>
                </td>
            </tr>   
        <?php
    };
?>  
        </table>
    </div>  
    <div class="botones-container">  
        <a href="../HTML/admin.html" class="boton">Volver</a></div>
    </div>
        <script src="../JS/confirmacionChofer.js"></script>
</body>
</html>