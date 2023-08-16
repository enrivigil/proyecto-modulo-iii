<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/centros-tech" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de centros tech</span>
            </a>
            <h3>Editar centro tech</h3>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center">Editar centro tech</h5>
        </div>
        <div class="card-body p-5">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">

                    <form action="/centros-tech/editar/<?= $centroTech['id'] ?>" method="post">

                        <?= csrf_field() ?>

                        <input type="hidden" name="id" value="<?= $centroTech['id'] ?>">

                        <div class="mb-3">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control
                                <?php if (isset($errors) && isset($errors['nombre'])): ?>
                                    border-danger
                                <?php endif ?>"
                                placeholder="Nombre" value="<?= $centroTech['nombre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" rows="5" class="form-control" placeholder="Descripcion"><?= $centroTech['descripcion'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Estado</label>
                            <select name="activo" id="activo" class="form-select">
                                <?php foreach ([true, false] as $i): ?>
                                    <option value="<?= $i ?>"
                                    <?php if ($centroTech['activo'] == $i): ?>
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
                            <a href="/centros-tech" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>
