
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
  
  $(document).on("submit", "#loginClient", function (event) {
    event.preventDefault();
    var data = $(this).serialize();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: baseurl+"ClientLogin/ingresarSistema",
      data: data,
      success: function (response) {
        console.log(response);
        if(response){
          if (response == 'success') {
              window.location.href = "./ClientInicio";
          }else{
              Swal.fire({ text: response, icon: "error", showConfirmButton: false });
          }
        }
      },
    });
  });
  