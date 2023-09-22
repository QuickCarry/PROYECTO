<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/usuarios.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Usuarios</title>
</head>
<body>
    <header>
            <a href="#"><img src="../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
    </header>
    <h1>Gestion de usuarios</h1>
    <div class="table-container">
        <table class="table">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Contraseña</th>
                <th>Cargo</th>
                <th >Editar o Eliminar</th>
            </tr>
    
    <?php
    require('db.php');
    $sentencia="SELECT * from `usuarios`";
    $filas=$conn->query($sentencia);    
    foreach($filas->fetch_all(MYSQLI_ASSOC) as $fila){ ?>
            <tr>
                <td><?php echo $fila['id'];?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['apellido'];?></td>
                <td><?php echo $fila['correo'];?></td>
                <td><?php echo $fila['contraseña'];?></td>
                <td><?php echo $fila['cargo'];?></td>
                <td>
                <div class="container-imagenes">
                        <a href="editarPersona.php?id=<?php echo $fila["id"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                        <a href="deletePersona.php?id=<?php echo $fila["id"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a></td>
                </div>
            </tr> 
        <?php
    };
?>
        </table>
    </div> 
    <div class="botones-container">
        <a href="agregarUsuario.php" class="boton">Agregar</a>   
        <a href="../HTML/admin.html" class="boton">Volver</a>
    </div>
    <script src="../JS/confirmacionUsuarios.js"></script>
</body>
</html>