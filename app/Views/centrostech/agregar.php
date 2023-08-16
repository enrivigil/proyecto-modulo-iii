<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/centros-tech" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de centros tech</span>
            </a>
            <h3>Agregar centro tech</h3>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center">Agregar nuevo centro tech</h5>
        </div>
        <div class="card-body p-5">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">

                    <form action="/centros-tech/agregar" method="post">

                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="" class="form-label">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control 
                                <?php if (isset($errors) && isset($errors['nombre'])): ?>
                                    border-danger
                                <?php endif ?>"
                                placeholder="Nombre">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" rows="5" class="form-control" placeholder="Descripcion"></textarea>
                        </div>

                        <div class="mb-3 text-end">
                            <a href="/centros-tech" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>
