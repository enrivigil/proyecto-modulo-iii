<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/dispositivos" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de dispositivos</span>
            </a>
            <h3>Agregar dispositivo</h3>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center">Agregar nuevo dispositivo</h5>
        </div>
        <div class="card-body p-5">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">

                    <form action="/dispositivos/agregar" method="post">

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
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control" placeholder="Descripcion"></textarea>
                        </div>   
                        <div class="mb-3">
                            <label for="" class="form-label">Marca</label>
                            <input type="text" id="marca" name="marca" class="form-control
                                <?php if (isset($errors) && isset($errors['marca'])): ?>
                                    border-danger
                                <?php endif ?>"
                            placeholder="Marca">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Modelo</label>
                            <input type="text" id="modelo" name="modelo" class="form-control
                                <?php if (isset($errors) && isset($errors['modelo'])): ?>
                                    border-danger
                                <?php endif ?>"
                                placeholder="Modelo">
                        </div>                   
                        <div class="mb-3">
                            <label for="" class="form-label">Num. serie</label>
                            <input type="text" id="num_serie" name="num_serie" class="form-control
                                <?php if (isset($errors) && isset($errors['num_serie'])): ?>
                                    border-danger
                                <?php endif ?>"
                                placeholder="Num. serie">
                        </div>    
                        <div class="mb-3">
                            <label for="" class="form-label">Centro tech</label>
                            <select name="centro_tech_id" id="" class="form-select">
                                <?php foreach ($centrosTech as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>    

                        <div class="mb-3 text-end">
                            <a href="/dispositivos" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>
