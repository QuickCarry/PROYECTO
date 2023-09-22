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
        <img src="../IMAGES/LOGO_SISTEMA.png" alt="LOGO DEL SISTEMA" class="logo">
    </header>

    <div class="container-add">
        <h2 class="container__title">Registrar Deposito</h2>
        <form action="../PHP/agregarDeposito.php" method="post" class="container__form">
        <div class="form-row">
            <label class="container__label">Departamento:</label>
            <input name="departamento" type="text" class="container_input"></input>
        </div>    
        <div class="form-row">
            <label class="container__label">Ruta:</label>
            <input name="Ruta" type="text" class="container_input"></input>
        </div>    
        <div class="form-row">
            <label class="container__label">ID</label>
            <input name="id" type="number" class="container_input"></input>
        </div>
            <a href="../admin.html"><input type="submit" value="Registrar" class="container__submit"></a>
        </form>
    </div>
    <?php
    require('db.php');
    if(isset($_POST['departamento']) && isset($_POST['Ruta']) && isset($_POST['id'])){
    $id = $_POST["id"];
    $departamento = $_POST["departamento"];
    $ruta = $_POST["Ruta"];
    //$numero = $_POST["numeroPuerta"];
    $sentencia = "INSERT INTO almacenescarry(IDCarry ,Departamento, Ruta) VALUES ('$id','$departamento','$ruta')";
    $resultadoAlta = $conn->query($sentencia);
        if($resultadoAlta){
            echo "<script>alert('Se ha registrado el deposito con exito'); window.location='/'</script>";
            header("Location: ../PHP/gestion_depositos.php");
        }else{
        echo "<script>alert('No se pudo añadir');</script>";
        }
}

?>
</body>
</html>