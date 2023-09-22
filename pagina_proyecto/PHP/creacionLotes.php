<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../STYLES/lote.css">
    <link rel="icon" type="image/x-icon" href="../IMAGES/LOGO_ICONO.ico">
    <title>Creacion de lotes</title>
</head>

<body>
    <header>
        <div class="logo">
            <a href="#"> <img src="../IMAGES/LOGO_SISTEMA.png" alt="" class="logo"></a>
        </div>
    </header>

    <div class="container-add">
        <h2 class="container__title">Creacion de lote</h2>
        <form action="../PHP/creacionLotes.php" method="post" class="container__form">
            <label class="container__label" hidden>Id Lote</label>
            <input type="number" name="idLote" class="container_input" hidden></input>
        <div class="form-row">
            <label class="container__label">Destino</label>
            <input type="text" name="destino" class="container_input"></input>
        </div>
        <div class="form-row">
                <label for="container__label">Estado</label>
                <select name="estado" class="container_input">
                    <option value="En preparacion">En preparacion</option>
                    <option value="En camino">En camino</option>
                    <option value="Entregado">Entregado</option>
                </select>
            </div>
            <a href="../HTML/funcionario.html" class="registrar"><input type="submit" value="Registrar" class="container__submit"></a>
        </form>
    </div>
    <?php
    require('db.php');
    
    if(isset($_POST['idLote']) && isset($_POST['destino']) && isset($_POST['estado'])){
    require('apiAlmacen.php');
    $lote=new lote();
    $lote->post($_POST['destino'],$_POST['estado']);
      
    
    header("Location: ../HTML/funcionario.html");
    echo "<script> function confirmacionPaquete(event){
        if (confirm('No existe dicho almacen. ¿Quiere intentar de nuevo?')){
        return true;
        }else{
        event.preventDefault();
        }
        }</script>";
    }
    ?>
</body>

</html>