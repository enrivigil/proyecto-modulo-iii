<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/usuarios" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de usuarios</span>
            </a>
            <h3>Editar usuario</h3>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center">Editar usuario</h5>
        </div>
        <div class="card-body p-5">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">

                    <form action="/usuarios/editar/<?= $usuario['id'] ?>" method="post">

                        <?= csrf_field() ?>

                        <input type="hidden" id="id" name="id" value="<?= $usuario['id'] ?>">

                        <div class="mb-3">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" id="nombre" value="<?= $usuario['nombre'] ?>" name="nombre" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Apellido</label>
                            <input type="text" id="apellido" value="<?= $usuario['apellido'] ?>" name="apellido" class="form-control" placeholder="Apellido">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">DUI</label>
                            <input type="text" id="dui" value="<?= $usuario['dui'] ?>" name="dui" class="form-control" placeholder="000000000" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nombre de usuario</label>
                            <input type="text" id="nombre_usuario" value="<?= $usuario['nombre_usuario'] ?>" name="nombre_usuario" class="form-control" placeholder="Nombre de usuario" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" id="email" value="<?= $usuario['email'] ?>" name="email" class="form-control" placeholder="Email" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Rol</label>
                            <select name="rol_id" id="rol_id" class="form-select">
                                <?php foreach ($roles as $i): ?>
                                    <option 
                                        value="<?= $i['id'] ?>"
                                        <?php if ($usuario['rol_id'] == $i['id']): ?> selected <?php endif ?>
                                    ><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Estado</label>
                            <select name="activo" id="activo" class="form-select">
                                <?php foreach ([true, false] as $i): ?>
                                    <option value="<?= $i ?>"
                                    <?php if ($usuario['activo'] == $i): ?>
                                        selected
                                    <?php endif ?>
                                    >
                                        <?php if ($i == 0): ?>
                                            Inactivo
                                        <?php else: ?>
                                            Activo
                                        <?php endif ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="/usuarios" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>
