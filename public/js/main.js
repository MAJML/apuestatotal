if(baseurl){
  Mostrarsaldo()
}
function Mostrarsaldo(){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: baseurl+"ClientInicio/mostrarSaldo",
        data: {data: $('#jugador').val()},
        success: function (response) {
          $('#saldoFijo').html(response.saldo)
        },
      });
}