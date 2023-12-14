
<?php


if (
    isset($_POST['correo'], $_POST['contra'], $_POST['nombre'], $_POST['usuario']) &&
    !empty($_POST['correo']) && !empty($_POST['contra']) &&
    !empty($_POST['nombre']) && !empty($_POST['usuario'])
) {
   
    require_once 'MYSQL.php';

  
    $correo = $_POST['correo'];
    $contra = $_POST['contra'];
    $nombre = $_POST['nombre'];
    $alias = $_POST['usuario'];

   
    $mysql = new MYSQL();
    $mysql->conectar();

  
    $consultaExistencia = $mysql->efectuarConsulta("select * from tallercamilo.usuario where usuario = '$alias'");

    if (mysqli_num_rows($consultaExistencia) > 0 ) {
      
        header("location: usuario_existente.php");
        exit(); 
    }else{
        $usuario = $mysql->efectuarConsulta("insert into tallercamilo.usuario(contraUsuario, correo, idUsuario, nombreUsuario, usuario) values ('$contra', '$correo', '', '$nombre', '$alias')");

        $mysql->desconectar();
    
        if ($usuario) {
            header("location: users.php");
        } else {
            header("location: error.php");
        }
    }

   
   
       
}