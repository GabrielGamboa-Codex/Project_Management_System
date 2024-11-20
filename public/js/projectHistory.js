//Metodo Ajax

$(document).ready(function () {
  var projectTable = $("#historyTable").DataTable({
    ajax: {
      url: "handler/projectHistoryHandler.php",
      method: "POST",
      data: { action: "printTable" },
      dataSrc: function (json) {
        console.log(json); // Verificar la respuesta en la consola
        return json.data;
      },
    },
    columnDefs: [
      { visible: false, targets: 1 },
      { visible: false, targets: 4 },
    ],
    columns: [
      { data: "id" },
      { data: "projectId" },
      { data: "projectName" },
      { data: "action" },
      { data: "userId" },
      { data: "userName" },
      { data: "timestamp" },
    ], 
    initComplete: function () {
      //instancia la api para ejecutar los metodos en el resto del codigo
      var search = this.api();

      // reccorre cada columna para hacer la busqueda
      search.columns().every(function () {
        var column = this;

        //Verifica que el select tenga algun valor en esa columnna
        if ($(column.header()).find("select").length > 0) {
          //si tiene un valor se activa un evento change que es para cambiar dependiendo del valor en el select
          $("select", column.header()).on("change", function () {
            //escapeRegex es una funcion de dataTable que sirve para ignorar cualquier caracter especial en la busqueda
            //fn.dataTable es la forma en que se accede a las funcionalidades y utilidades del plugin DataTables.
            //util nombre del acceso para entrar en las utilidades
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            //val si hay un valor va a filtrarlo en base a eso y con draw redibuja la tabla si no hay nada la vuelve a dejar como
            //originalmente estaba
            //true significa que la busqueda es un patron irregular
            //false signficia que no debe ser sensible a mayusculas y minusculas
            column.search(val ? "^" + val + "$" : "", true, false).draw();
          });
        }
      });
    },
  });

});
