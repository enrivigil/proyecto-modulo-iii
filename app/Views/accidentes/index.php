<?= $this->extend('shared/master') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>

    <?php if (session()->get('rol_id') == 1): ?>
        <!-- Modal -->
        <div class="modal fade" id="modalCambiarEstadoAccidente" tabindex="-1" aria-labelledby="modalCambiarEstadoAccidenteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCambiarEstadoAccidenteLabel">Cambiar estado a la notificacion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
    
                        <div class="alert alert-warning" role="alert">
                            Advertencia, estás a punto de cambiar el estado a un accidente
                        </div>
    
                        <div class="mb-3">
                            <label for="">Accidente</label>
                            <input type="text" id="accidente" class="form-control bg-white border-0" readonly>
                        </div>
    
                        <form action="/accidentes/cambiar-estado" method="post">
    
                            <?= csrf_field() ?>
    
                            <input type="hidden" id="id" name="id">
                            <div class="mb-3">
                                <label for="" class="form-label">Estado del accidente</label>
                                <select name="estado_id" id="estado_id" class="form-select">
                                    <?php foreach ($estados as $i): ?>
                                        <option 
                                            value="<?= $i['id'] ?>"
                                        >
                                            <?= $i['nombre'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
    
                            <div class="mb-3 text-end">
                                <button type="button" class="btn btn-link text-muted" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Cambiar estado</button>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/dashboard" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Dashboard</span>
            </a>
            <h3>Lista de accidentes</h3>
        </div>
        <div class="col-sm-12 col-md-6 text-end">
            <a href="/accidentes/agregar" class="btn btn-primary">Nuevo accidente</a>
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
                            <th>Titulo</th>
                            <th>Fecha notificacion</th>
                            <th>Estado</th>
                            <th>Notificador</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($accidentes as $i): ?>
                            <tr>
                                <td><?= $i['id'] ?></td>
                                <td><?= $i['titulo'] ?></td>
                                <td><?= $i['fecha_notificacion'] ?></td>
                                <td>
                                    <span class="badge text-primary" style="background-color: #DEEBFF;"><?= $i['estado'] ?></span>
                                </td>
                                <td><?= $i['notificador'] ?></td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <?php if (session()->get('rol_id') == 1 && $i['estado'] != 'Resuelto'): ?>
                                            <button type="button" class="btn btn-link p-1 btn-editar-estado" data-bs-toggle="modal" data-bs-target="#modalCambiarEstadoAccidente" title="Cambiar estado" data-id="<?= $i['id'] ?>" data-accidente="<?= $i['titulo'] ?>" data-estado-id="<?= $i['idestado'] ?>">
                                                <i data-feather="edit"></i>
                                            </button>
                                        <?php endif ?>
                                        <a href="/accidentes/detalles/<?= $i['id'] ?>" class="btn btn-link p-1" title="Info">
                                            <i data-feather="info"></i>
                                        </a>
                                        <?php if (session()->get('rol_id') == 1 && $i['estado'] != 'Resuelto'): ?>
                                            <a href="/accidentes/resolucion/<?= $i['id'] ?>" class="btn btn-link p-1" title="Hacer resolucion">
                                                <i data-feather="check-circle"></i>
                                            </a>
                                        <?php endif ?>
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

    $('.btn-editar-estado').on('click', function () {

        let id = $(this).attr('data-id')
        let accidente = $(this).attr('data-accidente')
        let estadoid = $(this).attr('data-estado-id')

        $('#id').val(id)
        $('#accidente').val(`${id} - ${accidente}`)
        $('#estado_id').val(estadoid)

    })
</script>
<?= $this->endSection() ?>
