<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Admin</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        html {
            font-size: 14px;
        }

        body {
            color: #253858;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            max-width: 1000px;
        }

        .feather {
            height: 20px;
            width: 20px;
        }

        .navbar .nav-link {
            color: inherit !important;
        }
        
        .navbar .nav-link.active {
            color: #0d6efd !important;
        }

        .badge {
            font-size: 13px !important;
            font-weight: normal;
        }

        .badge.bg-success {
            background-color: #E3FCEF !important;
            color: #00875A !important;
        }

        .badge.bg-danger {
            background-color: #FFEBE6 !important;
            color: #DE350B !important;
        }

        .badge.bg-warning {
            background-color: #FFFAE6 !important;
            color: #FFC400 !important;
        }

        .badge.bg-info {
            background-color: #DEEBFF !important;
            color: #0d6efd !important;
        }

        .alert-success {
            background-color: #E3FCEF !important;
            border-color: #E3FCEF !important;
            color: #00875A !important;
        }

        .alert-danger {
            background-color: #FFEBE6 !important;
            border-color: #FFEBE6 !important;
            color: #DE350B !important;
        }

        .alert-warning {
            background-color: #FFFAE6 !important;
            border-color: #FFFAE6 !important;
            color: #FFC400 !important;
        }

        .alert-info {
            background-color: #DEEBFF !important;
            border-color: #DEEBFF !important;
            color: #0d6efd !important;
        }

        .text-muted {
            color: #A5ADBA !important;
        }

        .dropdown-menu {
            min-width: 14rem;
        }

        .dropdown-item {
            padding: 8px 20px !important;
        }

        #preloader {
            background-color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000001;
        }

    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body>

    <div id="preloader">
        <img src="<?= base_url() ?>/1488.gif" alt="" width="64">
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container-fluid">
            <a href="/dashboard" class="navbar-brand">Logo</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <i data-feather="menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link d-flex align-items-center" id="dashboard">
                            <i data-feather="grid"></i>
                            <span class="ms-1">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/accidentes" class="nav-link d-flex align-items-center" id="accidentes">
                            <i data-feather="clipboard"></i>
                            <span class="ms-1">Accidentes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/reportes" class="nav-link d-flex align-items-center" id="reporte">
                            <i data-feather="folder"></i>
                            <span class="ms-1">Reportes</span>
                        </a>
                    </li>
                    <?php if (session()->get('rol_id') == 1): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="administracion" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="user"></i>
                                Administracion
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="administracion">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="/centros-tech">
                                        <i data-feather="cloud"></i>
                                        <span class="ms-1">Centros tech</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="/dispositivos">
                                        <i data-feather="smartphone"></i>
                                        <span class="ms-1">Dispositivos</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="/usuarios">
                                        <i data-feather="users"></i>
                                        <span class="ms-1">Accesos</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif ?>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDdwn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i data-feather="user"></i>
                            <span class="ms-1"><?= session()->get('nombre') . ' ' . session()->get('apellido') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDdwn">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/logout">
                                    <i data-feather="log-out"></i>
                                    <span class="ms-1">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <div class="container py-5">
            <?= $this->include('shared/messages') ?>
            <?= $this->renderSection('main-content') ?>
        </div>
    </main>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>
      feather.replace()
    </script>
    <script>

        const element = document.querySelector('#<?= $modulo ?>')
        element.classList.add('active');

        window.addEventListener('DOMContentLoaded', (e) => {
            setTimeout(() => {
                document.querySelector('#preloader').style.display = 'none';
            }, 500);
        });

    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>