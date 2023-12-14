
<?php
require_once 'MYSQL.php';
$mysql = new MYSQL();
$mysql->conectar();
$consulta = $mysql->efectuarConsulta("select * from tallercamilo.productos");
$mysql->desconectar();

$mysql->conectar();
$traerUsuarios = $mysql->efectuarConsulta("select idUsuario,nombreUsuario from tallercamilo.usuario");
$mysql->desconectar();

?>











<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="./isset/css/styleProducto.css">
<div class="container-fluid">
<div style=" margin-bottom: 60px;" class="row header">
<div class="col"><nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand">Tienda Restrepo</a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
  </div>
</nav></div>
</div>
<?php if(isset($_SESSION['mensaje'])){ ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Atencion</strong> <?php echo $_SESSION['mensaje'] ?>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php session_unset(); } ?>
<div class="row">
    <div class="col">
    <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Productos</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Agregar</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      
      <div class="offcanvas-body">
      <form  action="codiProductos.php"  method="post" enctype="multipart/form-data">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li style=" margin-bottom: 30px;"class="nav-item">
          <input name="nombreProducto" class="form-control me-2" type="search" placeholder="Nombre" aria-label="Search">
          </li>
          <li class="nav-item">
          <input name="cantidadProducto" class="form-control me-2" type="search" placeholder="Cantidad" aria-label="Search">
          </li>
          
          <li class="nav-item dropdown">
            <input id="idUsuario" name="idUsuario" type="text" hidden >
            <a  id="selecioneUsuario" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Selecione Usuario
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
    <?php while ($user = mysqli_fetch_array($traerUsuarios)) { ?>
        <li>
            <a class="dropdown-item hola" href="#" onclick="obtenerValor('<?php echo $user[1] ?>','<?php echo $user[0] ?>')">
                <button type="button" class="btn-Nombre"><?php echo $user[1] ?></button>
            </a>
        </li>
    <?php } ?>
</ul>
          </li>
        </ul>
        
          <input name="imagenProducto" class="form-control me-2" type="file" placeholder="Selecione Imagen" aria-label="Search">
          <button style=" margin-top: 30px;" class="btn btn-success" type="submit">Guardar</button>
        
        </form>
      </div>
    
    </div>
  </div>
</nav>
    </div>
</div>


<div class="row">
<div class="col">
<table class="table table-success table-striped">
 <thead>
    <tr>
        <th>Imagen</th>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Usuario</th>
        <th></th>
    </tr>
 </thead>
 <tbody>
<?php
while($fila = mysqli_fetch_array($consulta)){?>
<form action="">
<tr>
<?php


// Verifica si el archivo existe
if (file_exists('./imagenes/'.$fila[3])) {
    // El archivo existe, puedes mostrar la imagen
    echo '<td><img style="height: 80px;  width: 80px;  border-radius: 30px;
    " src="./imagenes/'.$fila[3].'" alt="" srcset="./imagenes/'.$fila[3].'"></td>';
} else {
    // El archivo no existe, puedes mostrar una imagen predeterminada o algún mensaje de error
    echo '<td><img src="ruta/a/tu/carpeta/imagen_predeterminada.jpg" alt="Imagen no encontrada"></td>';
}
?>
    <td><?php echo $fila[0]?></td>
    <td><?php echo $fila[1]?></td>
    <td><?php echo $fila[2]?></td>
    <td><?php echo $fila[4]?></td>
    <!-- aca voy a poner el boton donde va poner las opciones de editar o eliminar -->
    <td>
        <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Detalle
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Ver</a></li>
    <li><a  class="dropdown-item" href="#">Editar</a></li>
    <li><a onclick="idProducto('<?php echo $fila[0] ?>')"  class="dropdown-item" href="#">Eliminar</a></li>
  
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Otro</a></li>
  </ul>
</div>
</td>
    <!------------------------------------------------------------>
</tr>
</form>
<?php }?>

 </tbody>
</table>
</div>
</div>

</div>



<script src="./isset/js/mainProductos.js"></script>
<script src="./node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!--aca voy a colocar el javaScrit para coger el id del producto y enviarlo a URL para eliminar -->
<script>
    const idProducto = (id) => {

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Estas seguro de Eliminar?",
            text: "Ya no hay vuelta atrás!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Si, Eliminar!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar la solicitud al servidor PHP con el id
                // Utilizando una petición AJAX por ejemplo
                // Aquí puedes adaptar la URL y el método según tu configuración
                fetch('eliminar_producto.php?id=' + id, {
                    method: 'DELETE', // Puedes usar 'POST' u otro método según tu configuración
                })
                .then(response => response.json())
                .then(data => {
                    // Manejar la respuesta del servidor
                    if (data.success) {
                        swalWithBootstrapButtons.fire({
                            title: "Eliminado!",
                            text: "Se eliminó con éxito.",
                            icon: "success"
                            
                        });
                        
                    } else {
                        swalWithBootstrapButtons.fire({
                            title: "Error",
                            text: "Hubo un error al eliminar.",
                            icon: "error"
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    swalWithBootstrapButtons.fire({
                        title: "Error",
                        text: "Hubo un error al comunicarse con el servidor.",
                        icon: "error"
                    });
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Tu archivo imaginario está a salvo :)",
                    icon: "error"
                });
            }
        });
       
    }
  
</script>
