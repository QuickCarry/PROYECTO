<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/lote.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Lotes</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
        </div>
    </header>
    <h1>Lotes</h1><br>
    <div class="table-container">
        <table class="table">
            <tr>
                <th hidden>Id lote</th>
                <th>Estado</th>
                <th>Destino</th>
                <th>Editar o eliminar</th>
            </tr>
    <?php
    require('db.php');
    $sentencia = "SELECT * from `lote`";
    $filas = $conn->query($sentencia);
    foreach ($filas->fetch_all(MYSQLI_ASSOC) as $fila) { ?>
                <tr>
                    <td hidden><?php echo $fila['IdLote']; ?></td>
                    <td><?php echo $fila['EstadoLote']; ?></td>
                    <td><?php echo $fila['DestinoLote']; ?></td>
                    <div class="container-imagenes">
                        <td>
                            <a href="editarLote.php?id=<?php echo $fila["IdLote"];?>"><img src="../IMAGES/editar.svg" alt="" class="edit"></a> 
                            <a href="deleteLote.php?id=<?php echo $fila["IdLote"];?>" class="item_delete"><img src="../IMAGES/equis.svg" class="x"></a>
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
    <script src="../JS/confirmacionLote.js"></script>
</body>

</html>