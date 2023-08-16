<?= $this->extend('shared/master') ?>

<?= $this->section('styles') ?>
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/accidentes" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de accidentes</span>
            </a>
            <h3>Detalles</h3>
        </div>
        <div class="col-sm-12 col-md-6 text-md-end">
            <!-- <a href="#" class="btn btn-light">
                <i data-feather="file"></i>
                <span>PDF</span>
            </a> -->
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header bg-white text-center">
                    <h5 class="card-title">
                        Datos del accidente
                    </h5>
                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <img src="<?= base_url() . '/' . $accidente['foto'] ?>" alt="img evidence" class="d-block w-100 rounded mb-3" width="">
                        </div>
                        <div class="col-sm-12 col-md-7">

                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <h5 class="fs-6"><?= $accidente['nombredispositivo'] ?></h5>
                                        <p class="text-muted">Dispositivo</p>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="fs-6"><?= $accidente['num_serie'] ?></h5>
                                        <p class="text-muted">Num. serie</p>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="fs-6"><?= $accidente['titulo'] ?></h5>
                                        <p class="text-muted">Titulo</p>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="fs-6"><?= $accidente['descripcion'] ?></h5>
                                        <p class="text-muted">Descripcion</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <h5 class="fs-6"><?= $accidente['tipoaccidente'] ?></h5>
                                        <p class="text-muted">Tipo de accidente</p>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="fs-6"><?= $accidente['fecha_notificacion'] ?></h5>
                                        <p class="text-muted">Fecha notificacion</p>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="fs-6">
                                            <span class="badge text-primary" style="background-color: #DEEBFF;"><?= $accidente['estado'] ?></span>
                                        </h5>
                                        <p class="text-muted">Estado</p>
                                    </div>
                                    <div class="mb-3">
                                        <h5 class="fs-6"><?= $accidente['notificador'] ?></h5>
                                        <p class="text-muted">Notificador</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4">

            <div class="card">
                <div class="card-header bg-white text-center">
                    <h5 class="card-title">Resolucion</h5>
                </div>
                <div class="card-body">
                    
                    <img src="<?= base_url() . '/' . $accidente['foto_res'] ?>" alt="Img de evidencia" class="d-block w-100 mb-3 rounded" width="200">

                    <div class="mb-3">
                        <h5 class="fs-6">
                            <?php if (empty($accidente['resolucion'])): ?>
                                Sin resolucion
                            <?php else: ?>
                                <?= $accidente['resolucion'] ?>
                            <?php endif ?>
                        </h5>
                        <p class="text-muted">Resolucion</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="fs-6">
                            <?php if (empty($accidente['fecha_resolucion'])): ?>
                                Sin resolucion
                            <?php else: ?>
                                <?= $accidente['fecha_resolucion'] ?>
                            <?php endif ?>
                        </h5>
                        <p class="text-muted">Fecha resolucion</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<?= $this->endSection() ?>
