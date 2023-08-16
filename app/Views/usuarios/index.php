<?= $this->extend('shared/master') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>

    <!-- Modal para cambiar la contrasenia -->
    <div class="modal" id="modalCambiarContrasenia" tabindex="-1" aria-labelledby="modalCambiarContraseniaLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCambiarContraseniaLabel">Resetear contraseña</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="alert alert-warning" role="alert">
                        Advertencia, estás a punto de cambiar una contraseña
                    </div>

                    <div class="mb-3">
                        <label for="">Usuario</label>
                        <input type="text" id="usuario" class="form-control" readonly>
                    </div>

                    <form action="/usuarios/contrasenia/resetear" method="post">

                        <?= csrf_field() ?>
                        <input type="hidden" id="id" name="id">

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
            <a href="/dashboard" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Dashboard</span>
            </a>
            <h3>Lista de usuarios</h3>
        </div>
        <div class="col-sm-12 col-md-6 text-end">
            <a href="/usuarios/agregar" class="btn btn-primary">Nuevo usuario</a>
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
                            <th>Apellido</th>
                            <th>DUI</th>
                            <th>Nombre de usuario</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($usuarios as $i): ?>
                            <tr>
                                <td>#<?= $i['id'] ?></td>
                                <td><?= $i['nombre'] ?></td>
                                <td><?= $i['apellido'] ?></td>
                                <td><?= $i['dui'] ?></td>
                                <td><?= $i['nombre_usuario'] ?></td>
                                <td><?= $i['email'] ?></td>
                                <td>
                                    <?php if ($i['activo'] == 1): ?>
                                        <span class="badge bg-success">Activo</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactivo</span>
                                    <?php endif ?>
                                
                                </td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-link p-1 btn-editar-contrasenia" data-bs-toggle="modal" data-bs-target="#modalCambiarContrasenia" data-id="<?= $i['id'] ?>" data-usuario="<?= $i['nombre'] . ' ' . $i['apellido'] ?>">
                                            <i data-feather="unlock"></i>
                                        </button>
                                        <a href="/usuarios/detalles/<?= $i['id'] ?>" class="btn btn-link p-1">
                                            <i data-feather="info"></i>
                                        </a>
                                        <a href="/usuarios/editar/<?= $i['id'] ?>" class="btn btn-link p-1">
                                            <i data-feather="edit-2"></i>
                                        </a>
                                        <a href="/usuarios/eliminar/<?= $i['id'] ?>" class="btn btn-link p-1" onclick="return confirm('Estas seguro de querer elminar?')">
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
