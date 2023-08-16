<?= $this->extend('shared/master') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/dashboard" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Dashboard</span>
            </a>
            <h3>Lista de centros tech</h3>
        </div>
        <div class="col-sm-12 col-md-6 text-end">
            <a href="/centros-tech/agregar" class="btn btn-primary">Nuevo centro tech</a>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($centrosTech as $i): ?>
                            <tr>
                                <td>#<?= $i['id'] ?></td>
                                <td><?= $i['nombre'] ?></td>
                                <td><?= $i['descripcion'] ?></td>
                                <td>
                                    <?php if ($i['activo'] == 1): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactivo</span>
                                    <?php endif ?>
                                
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <a href="/centros-tech/detalles/<?= $i['id'] ?>" class="btn btn-link p-1">
                                            <i data-feather="info"></i>
                                        </a>
                                        <a href="/centros-tech/editar/<?= $i['id'] ?>" class="btn btn-link p-1">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <a href="/centros-tech/eliminar/<?= $i['id'] ?>" class="btn btn-link p-1" onclick="return confirm('Estas seguro de querer elminar?')">
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

    $('.btn-editar-contrasenia').on('click', function () {

        let id = $(this).attr('data-id')
        let usuario = $(this).attr('data-usuario')

        $('#id').val(id)
        $('#usuario').val(usuario)

    })
</script>
<?= $this->endSection() ?>
