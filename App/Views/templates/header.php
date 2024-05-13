<!doctype html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="https://www.apuestatotal.com/favicon.ico" type="image/x-icon">
    <title><?= $title ?? '' ?></title>
    <link href="<?= $baseUrl ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$baseUrl?>css/material-ui.css">
    <script src="<?=$baseUrl?>js/sweetalert2.min.js"></script>
    <link href="<?=$baseUrl?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$baseUrl?>css/dataTables.dataTables.css">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <?php if($_SESSION['client_user'] != null){ ?>
        <script> var baseurl = "<?= $baseUrl?>";</script>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="<?=$baseUrl?>ClientInicio"><img
                        src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Apuesta_total_logo.svg" width="150px"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="">Juegos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$baseUrl?>ClientRecarga">Recargar Saldo</a>
                        </li>
                    </ul>
                    <div class="nav-item mx-5">
                        <p class="nav-link mb-0">Saldo: <b>S/ <span id="saldoFijo">0</span></b></p>
                        <input type="hidden" id="jugador" value="<?=$_SESSION['client_player_id']?>">
                    </div>
                    <form class="d-flex" role="search">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?= $_SESSION['client_user'] ?? ''?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><b class="text-success">●</b> En Línea</a></li>
                                <li><a class="dropdown-item" href="<?= $baseUrl ?>ClientLogin/cerrar_sesion">Cerrar
                                        Sesion</a></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <?php }elseif($_SESSION['username'] != null){ ?>
        <script> var username = "11"</script>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="#"><img
                        src="https://upload.wikimedia.org/wikipedia/commons/d/d2/Apuesta_total_logo.svg" width="150px"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Historial Pagos</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?= $_SESSION['username'] ?? ''?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><b class="text-success">●</b> En Línea</a></li>
                                <li><a class="dropdown-item" href="<?= $baseUrl ?>Home/cerrar_sesion">Cerrar Sesion</a>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
        </nav>
        <?php } ?>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">