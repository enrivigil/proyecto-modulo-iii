<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/dispositivos" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de dispositivos</span>
            </a>
            <h3>Detalles</h3>
        </div>
        <div class="col-sm-12 col-md-6 text-md-end">
            <a href="/dispositivos/editar/<?= $dispositivo['id'] ?>" class="btn btn-light d-inline-flex align-items-center">
                <i data-feather="edit-2"></i>
                <span class="ms-1">Editar</span>
            </a>
            <a href="/dispositivos/eliminar/<?= $dispositivo['id'] ?>" class="btn btn-light d-inline-flex align-items-center" onclick="return confirm('Deseas eliminar este elemento?')">
                <i data-feather="trash"></i>
                <span class="ms-1">Eliminar</span>
            </a>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body p-5">

            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $dispositivo['nombre'] ?></h5>
                    <p class="text-muted">Nombre</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $dispositivo['descripcion'] ?></h5>
                    <p class="text-muted">descripcion</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $dispositivo['marca'] ?></h5>
                    <p class="text-muted">Marca</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $dispositivo['modelo'] ?></h5>
                    <p class="text-muted">Modelo</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $dispositivo['num_serie'] ?></h5>
                    <p class="text-muted">Numero de serie</p>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $dispositivo['centrotech'] ?></h5>
                    <p class="text-muted">Centro tech</p>
                </div>
                <div class="col-sm-12 col-md-4">
                    <h5 class="fs-6"><?= $dispositivo['estado'] ?></h5>
                    <p class="text-muted">Estado</p>
                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>
