var $dataTableClientes;
const $table = $("#tableClientes"),
  $tableHistorial = $("#tableHistorial");

function verHistorial(id) {
  if ($.fn.DataTable.isDataTable("#tableHistorial")) {
    $tableHistorial.DataTable().destroy();
  }
  $tableHistorial.DataTable({
    ajax: {
      url: "Inicio/listWhereHistorial",
      type: "POST",
      data: function () {
        return {
          id: id,
        };
      },
    },
    columns: [
      {
        title: "FECHA RECARGA",
        data: "created_at",
        render: function (data) {
          if (data != null) return moment(data).format("DD-MM-YYYY");
          return "-";
        },
      },
      { title: "PLAYER ID", data: "cliente_player" },
      {
        title: "ASESOR",
        data: null,
        render: function (data) {
          return data.asesor_nombre + " " + data.asesor_apellido;
        },
        orderable: false,
        searchable: false,
      },
      { title: "MONTO RECARGADO", data: "monto" },
      { title: "BANCO", data: "banco" },
      { title: "MEDIO DE PAGO", data: "medio_pago" },
    ],
  });
}

function verVoucher(id, idcliente) {
  $("#banco").val("");
  $("#banco").html("");
  $("#medio_pago").val("");
  $("#medio_pago_html").html("");
  $("#monto_recarga_hidden").val("");
  $("#id_cliente").val("");
  $("#id_solicitudR").val("");
  $("#emision").html("");
  $("#id_player").html("");
  $("#banco").html("");
  $("#codigo_recarga").html("");
  $("#monto_recarga").html("");
  $("#img_voucher").attr("src", "");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "Inicio/verPendienteVoucher",
    data: { id: id },
    success: function (response) {
      if (response.length > 0) {
        $("#medio_pago").val(response[0]["medio_pago"]);
        $("#medio_pago_html").html(response[0]["medio_pago"]);
        $("#banco").val(response[0]["banco"]);
        $("#banco_html").html(response[0]["banco"]);
        $("#monto_recarga_hidden").val(response[0]["monto"]);
        $("#id_cliente").val(idcliente);
        $("#id_solicitudR").val(response[0]["id_solicitud_recargas"]);
        $("#emision").html(response[0]["created_at"]);
        $("#id_player").html(response[0]["player_id"]);
        $("#banco").html(response[0]["banco"]);
        $("#codigo_recarga").html(response[0]["codigo_recarga"]);
        $("#monto_recarga").html(response[0]["monto"]);
        $("#img_voucher").attr("src", response[0]["voucher"]);
      }
    },
  });
}

function confirmarRecarga() {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "Inicio/confirmarRecarga",
    data: {
      id_cliente: $("#id_cliente").val(),
      id_solicitudR: $("#id_solicitudR").val(),
      monto: $("#monto_recarga_hidden").val(),
      banco: $("#banco").val(),
      medio_pago: $("#medio_pago").val(),
    },
    success: function (response) {
      if (response == "ok") {
        $dataTableClientes.ajax.reload();
        $(".btn-close").click();
        Swal.fire({
          title: "Listo",
          text:
            "Se le recargo S/" +
            $("#monto_recarga_hidden").val() +
            " a este cliente",
          icon: "success",
          showConfirmButton: false,
          timer: 1500,
        });
      } else {
        Swal.fire({
          text: "Hubo un error al recargar a este cliente",
          icon: "error",
          showConfirmButton: false,
          timer: 1500,
        });
      }
    },
  });
}

$(function () {
  $dataTableClientes = $table.DataTable({
    ajax: "Inicio/listClientes",
    columns: [
      {
        title: "N°",
        data: null,
        className: "text-center",
        render: function (data, type, row, meta) {
          return meta.row + 1;
        },
      },
      { title: "ID PLAYER", data: "player_id" },
      { title: "NOMBRE", data: "nombre" },
      { title: "APELLIDO", data: "apellido" },
      { title: "DNI", data: "dni" },
      { title: "CELULAR", data: "celular" },
      {
        title: "SALDO",
        data: null,
        render: function (data) {
          return "S/" + data.saldo;
        },
        orderable: false,
        searchable: false,
      },
      {
        data: null,
        render: function (data) {
          return (
            "<a href='javascript:(0)' data-bs-toggle='modal' data-bs-target='#modalHistorial' onclick='verHistorial(" +
            data.id +
            ")' class='badge text-bg-success text-white'>Historial</a>"
          );
        },
        orderable: false,
        searchable: false,
      },
      {
        data: null,
        render: function (data) {
          return (
            '<a href="javascript:(0)" ' +
            (data.voucher != null
              ? 'class="badge text-bg-info text-white" data-bs-toggle="modal" data-bs-target="#modalVoucher" onclick=verVoucher("' +
                data.player_id +
                '","' +
                data.id +
                '")'
              : 'class="badge text-bg-secondary text-white"') +
            ">Ver</a>"
          );
        },
        orderable: false,
        searchable: false,
      },
    ],
    rowCallback: function (row, data, index) {
      if (data.voucher != null) {
        $("td", row).css({
          "background-color": "#AED6F1",
          color: "#fff",
        });
      }
    },
  });
});
