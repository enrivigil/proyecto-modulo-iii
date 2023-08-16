<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/usuarios" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de usuarios</span>
            </a>
            <h3>Agregar usuario</h3>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center">Agregar nuevo usuario</h5>
        </div>
        <div class="card-body p-5">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">

                    <form action="/usuarios/agregar" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">DUI</label>
                            <input type="text" id="dui" name="dui" class="form-control" placeholder="000000000">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nombre de usuario</label>
                            <input type="text" id="nombre_usuario" name="nombre_usuario" class="form-control" placeholder="Nombre de usuario">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Contraseña</label>
                            <input type="password" id="contrasenia" name="contrasenia" class="form-control" placeholder="Contraseña">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Rol</label>
                            <select name="rol_id" id="rol_id" class="form-select">
                                <?php foreach ($roles as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="/usuarios" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>
