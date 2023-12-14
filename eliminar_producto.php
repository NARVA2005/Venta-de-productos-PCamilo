<?php
require_once 'MYSQL.php';
$mysql = new MYSQL();
$mysql->conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $mysql->efectuarConsulta("DELETE FROM tallercamilo.productos WHERE id = $id");

    if ($result) {
        $response = ['success' => true];
      
    } else {
        $response = ['success' => false, 'error' => 'Error al eliminar el producto'];
    }
} else {
    $response = ['success' => false, 'error' => 'ID no proporcionado'];
}

$mysql->desconectar();

header('Content-Type: application/json');
echo json_encode($response);

?>