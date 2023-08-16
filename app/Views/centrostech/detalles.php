<?= $this->extend('shared/master') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/centros-tech" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de centros tech</span>
            </a>
            <h3>Detalles</h3>
        </div>
        <div class="col-sm-12 col-md-6 text-md-end">
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-12 col-md-3">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title">Centro tech</h5>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <h5 class="fs-6"><?= $centroTech['nombre'] ?></h5>
                        <p class="text-muted">Nombre</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="fs-6">
                            <?php if(!empty($centroTech['descripcion'])): ?>
                                <?= $centroTech['descripcion'] ?>
                            <?php else: ?>
                                -
                            <?php endif ?>
                        </h5>
                        <p class="text-muted">Descripcion</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="fs-6">
                            <?php if($centroTech['activo']): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-success">Activo</span>
                            <?php endif ?>
                        </h5>
                        <p class="text-muted">Estado</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title">Lista de dispositivos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Dispositivo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dispositivos as $i): ?>
                                    <tr>
                                        <td>#<?= $i['id'] ?></td>
                                        <td><?= $i['nombre'] ?></td>
                                        <td class="text-end">
                                            <div class="btn-group">
                                                <a href="/dispositivos/detalles/<?= $i['id'] ?>" class="btn btn-link p-1">
                                                    <i data-feather="info"></i>
                                                </a>
                                                <a href="/dispositivos/editar/<?= $i['id'] ?>" class="btn btn-link p-1">
                                                    <i data-feather="edit-2"></i>
                                                </a>
                                                <a href="/dispositivos/eliminar/<?= $i['id'] ?>" class="btn btn-link p-1" onclick="return confirm('Estas seguro de querer elminar?')">
                                                    <i data-feather="trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('.table').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/es-ES.json'
        }
    })
</script>
<?= $this->endSection() ?>
