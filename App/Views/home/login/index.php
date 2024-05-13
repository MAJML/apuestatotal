<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://www.apuestatotal.com/favicon.ico" type="image/x-icon">
    <title><?= $title ?? '' ?></title>
    <link href="<?= $baseUrl ?>css/bootstrap.min.css" rel="stylesheet">
    <script>var baseurl = "<?=$baseUrl?>";</script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-material-ui/material-ui.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body class="container bg-body-tertiary">

    <section class="row d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form class="card col-md-4 row g-3 needs-validation" id="loginAdmin" method="post" novalidate>
            <div>
              <img src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Apuesta_total_logo.svg"  width="100%" alt="">
            </div>
            <div class="col-md-12">
                <label for="usuario" class="form-label">Usuario</label>
                <input autocomplete="off" type="text" class="form-control" id="usuario" name="usuario" required>
                <div class="invalid-feedback">
                    Ingrese su Usuario para poder Validarlo
                </div>
            </div>
            <div class="col-md-12">
                <label for="pass" class="form-label">Contraseña</label>
                <input autocomplete="off" type="password" class="form-control" id="pass" name="password" required>
                <div class="invalid-feedback">
                    Ingrese su Contraseña
                </div>
            </div>
            <div class="col-12 mb-4">
                <button class="btn btn-dark w-100" type="submit">Ingresar</button>
            </div>
        </form>
    </section>

</body>

<script src="<?=$baseUrl?>js/jquery-3.7.1.min.js"></script>
<script src="<?=$baseUrl?>js/home/index.js"></script>
</html>