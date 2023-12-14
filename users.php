<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="./isset/css/styleLogin.css">
    <title>Login</title>
</head>

<body>
<div class="container-fluid miLogin">
    <div class="nombre">
        <div class="col-5 todo">
            <form action="login.php" method="post">
                <div class="inpuus">
                    <label for="">Correo:</label>
                    <input name="correo" type="text" placeholder="escribir correo">

                </div>
                <div class="inpuus">
                    <label for="">Contraseña:</label>
                    <input name="contra" type="password" placeholder="escribir Contraseña">

                </div>
                <div class="inpuus">
                    <button>Entrar</button>

                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>