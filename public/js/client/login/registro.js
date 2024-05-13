const $dni = $("#dni");
let ajaxExecuted = false;
$(document).ready(function () {
  (() => {
    "use strict";
    const forms = document.querySelectorAll(".needs-validation");
    Array.from(forms).forEach((form) => {
      form.addEventListener(
        "submit",
        (event) => {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add("was-validated");
        },
        false
      );
    });
  })();
  dniValidato();
});

// REGISTRO DE CLIENTE
$(document).on("submit", "#registroClient", function (event) {
  event.preventDefault();
  var data = $(this).serialize();
  $.ajax({
    type: "POST",
    dataType: "json",
    url: baseurl + "ClientLogin/storeCliente",
    data: data,
    success: function (response) {
     $("#registroClient")[0].reset();
      if (response == "ok") {
        Swal.fire({
          text: "Excelente, ha creado su cuenta",
          icon: "success",
          showConfirmButton: false,
        });
      } else {
        Swal.fire({
          text: "Usted ya posee una cuenta",
          icon: "error",
          showConfirmButton: false,
        });
      }
    },
  });
});

function dniValidato() {
  $dni.keyup(function () {
    if ($dni.val().length == 8 && !ajaxExecuted) {
      ajaxExecuted = true;
      $.ajax({
        type: "POST",
        dataType: "json",
        url: baseurl + "ClientLogin/dniValidacion",
        data: { dni: $dni.val() },
        success: function (response) {
          /* console.log(response); */
          if (response.success == true) {
            $("#nombre").val(response.data.nombres);
            $("#apellido").val(
              response.data.apellido_materno +
                " " +
                response.data.apellido_paterno
            );
          } else {
            Swal.fire({
              text: "Ingrese correctamente su DNI",
              icon: "error",
              showConfirmButton: false,
            });
            $("#nombre").val("");
            $("#apellido").val("");
          }
        },
        complete: function () {
          ajaxExecuted = false;
        },
      });
    }
  });
}
