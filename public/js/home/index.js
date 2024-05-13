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

$(document).on("submit", "#loginAdmin", function (event) {
  event.preventDefault();
  var data = $(this).serialize();
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "Home/ingresarSistema",
    data: data,
    success: function (response) {
      if(response){
        if (response == 'success') {
            window.location.href = "./inicio";
        }else{
            Swal.fire({ text: "Credenciales Incorrectas", icon: "error", showConfirmButton: false });
        }
      }
    },
  });
});
