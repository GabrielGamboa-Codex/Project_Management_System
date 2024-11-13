


















//Metodo Ajax
$(document).ready(function () { 

          jQuery('#datepicker').datepicker({
            autoclose: true,
            minViewMode: 0,
            format: 'mm-dd-yyyy',
            todayHighlight: true
          });

        $.ajax({
            url: "handler/taskHandler.php",
            method: "POST",
            dataType: "json",
            data: { action: "printOptionsUser" },
            success: function (data) {
              data.forEach(function (item) {
                $("#assignerUser").append(
                  `<option value="${item.id}">${item.username}</option>`
                );
              });
            },
          });
        
          $.ajax({
            url: "handler/taskHandler.php",
            method: "POST",
            dataType: "json", //Tipo de datos que se espera recibir como respuesta.
            data: { action: "printOptionsProject" },
            success: function (data) {
              data.forEach(function (
                item //Recorre cada elemento en el array de datos recibido como respuesta.
              ) {
                $("#projectTeam").append(
                  `<option value="${item.id}">${item.name}</option>`
                ); //Añade contenido al final de los elemento seleccionados
              });
            },
          });
   
  
});