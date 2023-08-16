<?= $this->extend('shared/master') ?>

<?= $this->section('main-content') ?>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <a href="/accidentes" class="text-decoration-none d-flex align-items-center mb-2">
                <i data-feather="chevron-left"></i>
                <span class="ms-1">Lista de accidentes</span>
            </a>
            <h3>Resolucion accidente</h3>
        </div>
    </div>

    <br>

    <div class="card">
        <div class="card-header bg-white">
            <h5 class="text-center">Resolucion accidente</h5>
        </div>
        <div class="card-body p-5">

            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">

                    <form action="/accidentes/resolucion/<?= $accidente['id'] ?>" method="post" enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <input type="hidden" name="id" value="<?= $accidente['id'] ?>">
                        <div class="mb-3">
                            <label for="" class="form-label">Titulo</label>
                            <input type="text" class="form-control" placeholder="Titulo" value="<?=  $accidente['titulo'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Descripcion</label>
                            <textarea rows="3" class="form-control" placeholder="Descripcion" readonly><?= $accidente['descripcion'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Resolucion</label>
                            <textarea name="resolucion" id="resolucion" rows="3" class="form-control
                                <?php if (isset($errors) && isset($errors['resolucion'])): ?>
                                    border-danger
                                <?php endif ?>" placeholder="Resolucion"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="foto_res" class="form-label">Seleciona una foto como evidencia</label>
                            <input
                                type="file"
                                id="foto_res"
                                name="foto_res"
                                class="form-control
                                <?php if (isset($errors) && isset($errors['foto_res'])): ?>
                                    border-danger
                                <?php endif ?>">
                        </div>

                        <div class="mb-3 text-end">
                            <a href="/accidentes" class="btn btn-link text-muted">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar resolucion</button>
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
