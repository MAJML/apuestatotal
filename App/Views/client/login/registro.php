<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.apuestatotal.com/favicon.ico" type="image/x-icon">
    <title><?= $title ?? '' ?></title>
    <link href="<?= $baseUrl ?>css/bootstrap.min.css" rel="stylesheet">
    <script>var baseurl = "<?=$baseUrl?>";</script>
    <link href="<?=$baseUrl?>css/material-ui.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body class="container bg-body-tertiary">

    <section class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form class="p-4 card col-md-8 g-3 needs-validation" id="registroClient" method="post" novalidate>
            <span class="text-center">REGISTRATE</span>
            <div class="text-center">
              <img src="https://pbs.twimg.com/media/FiQs_aAXgAY1RAx.jpg"  width="300px" alt="">
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dni" class="form-label">DNI</label>
                    <input autocomplete="off" type="text" class="form-control" maxLength="8" id="dni" name="dni" required>
                    <div class="invalid-feedback">
                        Ingrese su DNI para validar sus Nombres
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input autocomplete="off" type="text" class="form-control" id="nombre" name="nombre" required readonly>
                    <div class="invalid-feedback">
                        Ingrese su Contraseña
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input autocomplete="off" type="text" class="form-control" id="apellido" name="apellido" required readonly>
                    <div class="invalid-feedback">
                        Ingrese su Apellido
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input autocomplete="off" type="text" class="form-control" maxLength="9" id="celular" name="celular" required>
                    <div class="invalid-feedback">
                        Es necesario que ingrese su numero de celular
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="correo" class="form-label">Correo</label>
                    <input autocomplete="off" type="email" class="form-control" id="correo" name="correo" required>
                    <div class="invalid-feedback">
                        Es necesario que ingrese su correo
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input autocomplete="off" type="password" class="form-control" id="pass" name="password" required>
                    <div class="invalid-feedback">
                        Es necesario que ingrese una contrasela mayor a 7 digitos
                    </div>
                </div>
                <div class="col-12 mb-4">
                    <button class="btn btn-danger w-100" type="submit">Registrar</button>
                </div>
                <div class="col-12 mb-2 text-center">
                    <a class="text-center" href="<?=$baseUrl?>ClientLogin">Regresar</a>
                </div>
            </div>
            
        </form>
    </section>

</body>

<script src="<?=$baseUrl?>js/jquery-3.7.1.min.js"></script>
<script src="<?=$baseUrl?>js/client/login/registro.js"></script>
</html>