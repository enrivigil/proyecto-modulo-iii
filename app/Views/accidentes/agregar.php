<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/accidentes" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de accidentes</span>
            </a>
            <h3>Agregar accidente</h3>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center">Agregar nuevo accidente</h5>
        </div>
        <div class="card-body p-5">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">

                    <form action="/accidentes/agregar" method="post" enctype='multipart/form-data'>

                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="" class="form-label">Titulo</label>
                            <input type="text" id="titulo" name="titulo" class="form-control 
                                <?php if (isset($errors) && isset($errors['titulo'])): ?>
                                    border-danger
                                <?php endif ?>" placeholder="Titulo">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" rows="3" class="form-control
                                <?php if (isset($errors) && isset($errors['descripcion'])): ?>
                                    border-danger
                                <?php endif ?>" placeholder="Descripcion"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tipo de accidente</label>
                            <select name="tipo_accidente_id" id="tipo_accidente_id" class="form-select">
                                <?php foreach ($tiposAccidentes as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Centro tecnologia</label>
                            <select name="centro_tech_id" id="centro_tech_id" class="form-select">
                                <option value="">Seleccione un CT</option>
                                <?php foreach ($centrosTech as $i): ?>
                                    <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Dispositivo</label>
                            <select name="dispositivo_id" id="dispositivo_id" class="form-select 
                                <?php if (isset($errors) && isset($errors['dispositivo_id'])): ?>
                                    border-danger
                                <?php endif ?>">
                                <option value="">Seleccione un dispositivo</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Seleciona una foto como evidencia</label>
                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                class="form-control
                                <?php if (isset($errors) && isset($errors['foto'])): ?>
                                    border-danger
                                <?php endif ?>">
                        </div>

                        <div class="mb-3 text-end">
                            <a href="/accidentes" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>

    $('#centro_tech_id').on('change', function () {
        let ctId = $(this).val()
        $.get(`/accidentes/ct/${ctId}/dispositivos`, function (res) {

            let data = JSON.parse(res)
            let html = '<option value="">Seleccione un dispositivo</option>';

            data.forEach(d => {
                html += `
                    <option value="${d.id}">${d.num_serie} - ${d.nombre}</option>
                `;
            })

            console.log(data);
            $('#dispositivo_id').html(html)
        })
    })

</script>
<?= $this->endSection() ?>
