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
        <form class="card col-md-4 row g-3 needs-validation" id="loginClient" method="post" novalidate>
            <span class="text-center">BIENVENIDO A</span>
            <div>
              <img src="https://pbs.twimg.com/media/FiQs_aAXgAY1RAx.jpg"  width="100%" alt="">
            </div>
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input autocomplete="off" type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback">
                    Ingrese su email para poder Validarlo
                </div>
            </div>
            <div class="col-md-12">
                <label for="pass" class="form-label">Contraseña</label>
                <input autocomplete="off" type="password" class="form-control" id="pass" name="password" required>
                <div class="invalid-feedback">
                    Ingrese su Contraseña
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-dark w-100" type="submit">Ingresa</button>
            </div>
            <div class="col-12 mb-4">
                <a class="btn btn-danger w-100" href="<?= $baseUrl ?>ClientLogin/registro">Registrate Aquí</a>
            </div>
        </form>
    </section>

</body>

<script src="<?=$baseUrl?>js/jquery-3.7.1.min.js"></script>
<script src="<?=$baseUrl?>js/client/login/index.js"></script>
</html>