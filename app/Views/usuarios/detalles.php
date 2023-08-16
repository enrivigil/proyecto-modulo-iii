<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

        <!-- Modal -->
        <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Resetear contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-warning" role="alert">
                        Advertencia, estás a punto de cambiar una contraseña
                    </div>

                    <div class="mb-3">
                        <label for="">Usuario</label>
                        <input type="text" id="usuario" class="form-control" value="<?= $usuario['nombre'] . ' ' . $usuario['apellido'] ?>" readonly>
                    </div>

                    <form action="/usuarios/contrasenia/resetear" method="post">

                        <?= csrf_field() ?>
                        <input type="hidden" id="id" name="id" value="<?= $usuario['id'] ?>">

                        <div class="mb-3">
                            <label for="">Nueva contraseña</label>
                            <input type="password" name="contrasenia" class="form-control">
                        </div>
                        <div class="mb-3 text-end">
                            <button type="button" class="btn btn-link text-muted" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/usuarios" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de usuarios</span>
            </a>
            <h3>Detalles</h3>
        </div>
        <div class="col-sm-12 col-md-6 text-md-end">
            <button type="button" class="btn btn-light d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i data-feather="unlock"></i>
                <span class="ms-1">Cambiar contraseña</span>
            </button>
            <a href="/usuarios/editar/<?= $usuario['id'] ?>" class="btn btn-light d-inline-flex align-items-center">
                <i data-feather="edit-2"></i>
                <span class="ms-1">Editar</span>
            </a>
            <button type="button" class="btn btn-light d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i data-feather="trash"></i>
                <span class="ms-1">Borrar</span>
            </button>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body p-5">

            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $usuario['nombre'] ?></h5>
                    <p class="text-muted">Nombre</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $usuario['apellido'] ?></h5>
                    <p class="text-muted">Apellido</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $usuario['dui'] ?></h5>
                    <p class="text-muted">DUI</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $usuario['nombre_usuario'] ?></h5>
                    <p class="text-muted">Nombre de usuario</p>
                </div>
                <div class="col-sm-12 col-md-8">
                    <h5 class="fs-6"><?= $usuario['email'] ?></h5>
                    <p class="text-muted">Email</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6">
                        <?php if($usuario['activo']): ?>
                            <span class="badge bg-success">Activo</span>
                        <?php else: ?>
                            <span class="badge bg-success">Activo</span>
                        <?php endif ?>
                    </h5>
                    <p class="text-muted">Estado</p>
                </div>
                <div class="col-sm-12 col-md-8">
                    <h5 class="fs-6">
                        <?php if($usuario['rol_id'] == 1): ?>
                            Administrador
                        <?php else: ?>
                            Usuario
                        <?php endif ?>
                    </h5>
                    <p class="text-muted">Rol</p>
                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>
