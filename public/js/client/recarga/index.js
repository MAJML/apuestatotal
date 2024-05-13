var $dataTableHistorialCliente;
const $table = $("#tableHistorialRecarga");
function InsertandoIdModel(idResgister){
    $("#voucher").val('');
    $("#vista_previa").attr('src', '');
    $("#idRegister").val(idResgister)
}
$(function () {
  $dataTableHistorialCliente = $table.DataTable({
    ajax: baseurl + "ClientRecarga/listSolicitudRecargas",
    columns: [
      {
        title: "N°",
        data: null,
        className: "text-center",
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
      },
      { title: "FECHA DE EMISION", data: "created_at" },
      { title: "ID JUGADOR", data: "player_id" },
      { title: "MONTO", data: "monto" },
      { title: "CODIGO DE RECARGA", data: "codigo_recarga" },
      {
        title: "ESTADO",
        data: null,
        render: function (data) {
          if (data.estado == 0) {
            return "<p class='badge bg-danger m-0'>Pendiente</p>";
          } else {
            return "<p class='badge bg-success m-0'>Pagado</p>";
          }
        },
      },
      {
        data: null,
        render: function (data) {
            if(data.estado == 1) {
                return "<span class='badge text-bg-success text-white'>Realizado</span>";
            }else{
                if(data.voucher != null){
                    return "<a href='javascript:(0)' class='badge text-bg-warning text-white'>Revisando</a>";
                }else{
                    return "<a href='javascript:(0)' data-bs-toggle='modal' data-bs-target='#modalSubirVoucher' onclick='InsertandoIdModel("+data.id+")' class='badge text-bg-info text-white'>Subir Voucher</a>";
                }
            }
        },
        orderable: false,
        searchable: false,
      },
    ],
  });
  
  $(document).on("submit", "#formSolicitudRecarga", function (event) {
    event.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: baseurl + "ClientRecarga/storeSolicitudRecarga",
      data: data,
      success: function (response) {
        $("#formSolicitudRecarga")[0].reset();
        if (response == "ok") {
          Swal.fire({
            text: "Se ha Habilitado un codigo de Pago, para que se acerque a un cajero y pague con el codigo",
            icon: "success",
            showConfirmButton: false,
          });
          $dataTableHistorialCliente.ajax.reload();
        } else {
          Swal.fire({
            text: response,
            icon: "error",
            showConfirmButton: false,
          });
        }
      },
    });
  });

  $("#voucher").change(function () {
    var imagen = this.files[0];
    if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
      $("#voucher").val("");
      Swal.fire({
        text: "La imagen debe estar en formato jpg o png",
        icon: "error",
        showConfirmButton: false,
        timer: 1500,
      });
    } else if (imagen["size"] > 5000000) {
      $("#voucher").val("");
      Swal.fire({
        text: "¡La imagen no debe pesar mas de 2MB",
        icon: "error",
        showConfirmButton: false,
        timer: 1500,
      });
    } else {
      var datosImagen = new FileReader();
      datosImagen.readAsDataURL(imagen);
      $(datosImagen).on("load", function (event) {
        var rutaImagen = event.target.result;
        $("#vista_previa").attr("src", rutaImagen);
      });
    }
  });

  $(document).on("submit", "#formSubirVoucher", function (event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: baseurl + "ClientRecarga/subirVoucher",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        $("#formSolicitudRecarga")[0].reset();
        if(response == 'ok'){
            Swal.fire({
                text: "Vaucher Subido, nuestros Asesores confirmaran en breve y obtendra su recarga",
                icon: "success",
                showConfirmButton: false,
            });
            $('.btn-close').click();
            $dataTableHistorialCliente.ajax.reload();
        }else{
            Swal.fire({
                text: "Intentelo mas tarde",
                icon: "error",
                showConfirmButton: false,
            });
        }
      },
    });
  });



});
