<?= $this->extend('shared/master') ?>

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<style>
    .nav {
        border-bottom: 2px solid #f5f8fa;
    }
    .nav .nav-link {
        color: inherit !important;
        font-weight: 500;
        padding: .875rem 1rem !important;
        position: relative;
        border-radius: 0;
    }

    .nav .nav-link.active {
        background-color: #fff !important;
        color: #0d6efd !important;
        border-bottom: 2px solid #0d6efd;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/dashboard" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Dashboard</span>
            </a>
            <h3>Reportes</h3>
        </div>
    </div>

    <br>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pill-accidente" data-bs-toggle="pill" data-bs-target="#accidente" type="button" role="tab" aria-controls="accidente" aria-selected="true">Reporte de accidentes</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pill-dispositivo" data-bs-toggle="pill" data-bs-target="#dispositivo" type="button" role="tab" aria-controls="dispositivo" aria-selected="true">Reporte de dispositivos</button>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade py-4" id="accidente" role="tabpanel" aria-labelledby="pill-accidente" tabindex="0">

            <div class="row">
                <div class="col-sm-3">

                    <div class="mb-4">
                        <h5>
                            <i data-feather="filter"></i>
                            Filtros
                        </h5>
                        <p class="text-muted">Filtros para la busqueda de elementos</p>
                    </div>

                    <form action="/reportes" method="get">

                        <input type="hidden" name="reporte" value="accidente">
                        <div class="mb-3">
                            <label for="">Tipo de accidente</label>
                            <select name="ta" id="ta" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($accidentes['tiposaccidente'] as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="">Estado</label>
                            <select name="ea" id="ea" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($accidentes['estadosaccidente'] as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="">Rangos de fechas</label>
                            <input type="date" name="fi" id="fi" class="form-control mb-2">
                            <input type="date" name="ff" id="ff" class="form-control mb-2">
                        </div>
    
                        <div class="mb-3">
                            <label for="">Notificador</label>
                            <select name="no" id="no" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($accidentes['usuarios'] as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] . ' ' . $i['apellido'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                            <a href="/reportes?reporte=accidente" class="btn btn-link w-100 text-muted">Limpiar</a>
                        </div>

                    </form>


                </div>
                <div class="col-sm-9">

                    <div class="card">
                        <div class="card-header bg-white">
                            <h5>Lista de accidentes</h5>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Titulo</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                            <th>Tipo accidente</th>
                                            <th>Notificador</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (count($accidentes['datos']) > 0): ?>
                                            <?php foreach ($accidentes['datos'] as $i): ?>
                                                <tr>
                                                    <td><?= $i['id'] ?></td>
                                                    <td><?= $i['titulo'] ?></td>
                                                    <td><?= $i['fecha_notificacion'] ?></td>
                                                    <td>
                                                        <span class="badge bg-info"><?= $i['estado'] ?></span>
                                                    </td>
                                                    <td><?= $i['tipo'] ?></td>
                                                    <td><?= $i['nombre'] . ' ' . $i['apellido'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <br>

        </div>
        <div class="tab-pane fade py-4" id="dispositivo" role="tabpanel" aria-labelledby="pill-dispositivo" tabindex="0">

            <div class="row">
                <div class="col-sm-3">

                    <div class="mb-4">
                        <h5>
                            <i data-feather="filter"></i>
                            Filtros
                        </h5>
                        <p class="text-muted">Filtros para la busqueda de elementos</p>
                    </div>

                    <form action="/reportes" method="get">

                        <input type="hidden" name="reporte" value="dispositivo">
                        <div class="mb-3">
                            <label for="">Centro tech</label>
                            <select name="ct" id="ct" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($dispositivos['centrostech'] as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="">Estado</label>
                            <select name="ed" id="ed" class="form-select">
                                <option value="">Todos</option>
                                <?php foreach ($dispositivos['estadosdispositivo'] as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
                            <a href="/reportes?reporte=dispositivo" class="btn btn-link w-100 text-muted">Limpiar</a>
                        </div>

                    </form>


                </div>
                <div class="col-sm-9">

                    <div class="card">
                        <div class="card-header bg-white">
                            <h5>Lista de dispositivos</h5>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Marca</th>
                                            <th>Modelo</th>
                                            <th>Num. serie</th>
                                            <th>Estado</th>
                                            <th>CT</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php if (count($dispositivos['datos']) > 0): ?>
                                            <?php foreach ($dispositivos['datos'] as $i): ?>
                                                <tr>
                                                    <td><?= $i['id'] ?></td>
                                                    <td><?= $i['nombre'] ?></td>
                                                    <td><?= $i['marca'] ?></td>
                                                    <td><?= $i['modelo'] ?></td>
                                                    <td><?= $i['num_serie'] ?></td>
                                                    <td>
                                                        <span class="badge bg-info"><?= $i['estado'] ?></span>
                                                    </td>
                                                    <td><?= $i['centrotech'] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <br>

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
<script>

    // para los accidentes
    const fa = '<?= $accidentes['filtros'] ?>';
    const filtrosAccidente = JSON.parse(fa);
    console.log(filtrosAccidente);

    if (filtrosAccidente) {
        document.querySelector(`#ta`).value = filtrosAccidente.ta || '';  // tipo accidente
        document.querySelector(`#ea`).value = filtrosAccidente.ea || '';  // estado accidente
        document.querySelector(`#fi`).value = filtrosAccidente.fi || '';  // estado accidente
        document.querySelector(`#ff`).value = filtrosAccidente.ff || '';  // estado accidente
        document.querySelector(`#no`).value = filtrosAccidente.no || '';  // notificador
    }

    // para los dispositivos
    const fd = '<?= $dispositivos['filtros'] ?>';
    const $filtrosDispositivo = JSON.parse(fd);
    console.log($filtrosDispositivo);

    if ($filtrosDispositivo) {
        document.querySelector(`#ct`).value = $filtrosDispositivo.ct || '';  // centro tech
        document.querySelector(`#ed`).value = $filtrosDispositivo.ed || '';  // estado dispositivo
    }

    // para los tabs
    const pillTab = '<?= $reporte ?>'
    document.querySelector(`#pill-${pillTab}`).classList.add('active');
    document.querySelector(`#${pillTab}`).classList.add('show', 'active');

</script>

<?= $this->endSection() ?>
