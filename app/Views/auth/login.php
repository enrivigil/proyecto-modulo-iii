<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Admin - Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        html {
            font-size: 14px;
        }

        body {
            font-family: 'Roboto', sans-serif;
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
</head>
<body>

    <div id="preloader">
        <img src="<?= base_url() ?>/1488.gif" alt="" width="64">
    </div>

    <div class="container my-5">

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-4">

                <?= $this->include('shared/messages') ?>

                <div class="card">
                    <div class="card-body p-5">

                        <form action="/login" method="post">

                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input 
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control
                                        <?php if (isset($errors) && isset($errors['email'])): ?>
                                            border-danger
                                        <?php endif ?>
                                    " 
                                    placeholder="Email"
                                >
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input 
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control
                                        <?php if (isset($errors) && isset($errors['password'])): ?>
                                            border-danger
                                        <?php endif ?>
                                    " 
                                    placeholder="Contraseña"
                                >
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script>

        window.addEventListener('DOMContentLoaded', (e) => {
            setTimeout(() => {
                document.querySelector('#preloader').style.display = 'none';
            }, 500);
        });

    </script>
</body>
</html>