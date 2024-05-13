<section class="container pt-4">
    <h3>Realiza tu Recarga</h3>
    <form class="row" method="post" id="formSolicitudRecarga">
        <div class="col-lg-3 mb-3">
            <label for="monto" class="form-label">Monto a Recargar: </label>
            <input type="text" class="form-control form-control-sm" id="monto" name="monto" pattern="[0-9.]*"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '')" maxLength=5
                placeholder="El Monto minimo de recarga es de S/20" required>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="banco" class="form-label">Banco de Preferencia</label>
            <select class="form-select form-select-sm" name="banco" id="banco" required>
                <option value="">-- Seleccione --</option>
                <?php foreach ($bancos as $row): ?>
                <option value="<?= $row->id ?>"><?= $row->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-lg-3 mb-3">
            <label for="medioPago" class="form-label">Medio de Pago</label>
            <select class="form-select form-select-sm" name="medioPago" id="medioPago" required>
                <option>TRANSFERENCIA</option>
                <option>EFECTIVO</option>
            </select>
        </div>
        <div class="col-lg-3 mb-3 form-check">
            <label for="exampleInputPassword1" class="form-label">.</label>
            <button type="submit" class="btn btn-outline-success btn-sm w-100">Habilitar Codigo de Pago</button>
        </div>
    </form>
    <hr>
    <h6>Pendientes a Pagar</h6>
    <table id="tableHistorialRecarga" class="display" style="width:100%"></table>
</section>

<!-- MODAL SUBIR VOUCHER -->
<div class="modal fade" id="modalSubirVoucher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Corroborar Pago</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row" method="post" id="formSubirVoucher" enctype="multipart/form-data">
                    <input type="hidden" name="idRegister" id="idRegister" required>
                    <div class="col-lg-12 mb-3">
                        <label for="voucher" class="form-label">Subir Voucher: </label>
                        <input type="file" class="form-control form-control-sm voucher" id="voucher" name="voucher" required>
                    </div>
                    <div class="col-lg-12 mb-3 border p-2">
                        <img src="" id="vista_previa" class="w-100" alt="">
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success btn-sm w-100">Subir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>