<div class="container pt-4">
    <h5>Todos Los Clientes</h5>
    <hr>
    <table id="tableClientes" class="display" style="width:100%"></table>
</div>

<!-- MODAL HISTORIAL -->
<div class="modal fade" id="modalHistorial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Historial de Recargas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="tableHistorial" class="display" style="width:100%"></table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VER VOUCHER -->
<div class="modal fade" id="modalVoucher" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Pendiente de pago</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <input type="hidden" id="medio_pago">
                        <input type="hidden" id="banco">
                        <input type="hidden" id="monto_recarga_hidden">
                        <input type="hidden" id="id_cliente">
                        <input type="hidden" id="id_solicitudR">
                        <p><b>Fecha de Emisión: </b><span id="emision"></span></p>
                        <p><b>ID Player: </b><span id="id_player"></span></p>
                        <p><b>Banco: </b><span id="banco_html"></span></p>
                        <p><b>Medio de Pago: </b><span id="medio_pago_html"></span></p>
                        <p><b>Codigo recarga: </b><span id="codigo_recarga"></span></p>
                        <p><b>Monto: </b>S/<span id="monto_recarga"></span></p>
                        <p><b>Voucher: </b></p>
                    </div>
                    <div class="col-lg-6 mx-auto w-25">
                        <img src="" class="w-100" id="img_voucher" alt="">
                    </div>
                </div>
                <hr>
                <div class="col-12 ">
                    <a href="javascript:void(0)" class="btn btn-success" onclick="confirmarRecarga()">Confirmar Recarga</a>
                </div>
            </div>
        </div>
    </div>
</div>