function validationPicker(event) 
{
  var char = String.fromCharCode(event.which);
  if (!/^[0-9\s-]+$/.test(char)) 
  {
    event.preventDefault();
    return false;
  }
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  var date = formData.date;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");

  var dateRegex = /^[0-9-]{1,10}$/;

  if (dateRegex.test(date)) 
    {
      message1.textContent = "Date is valid";
      message1.style.color = "green";
    } 
    else 
    {
      message1.textContent =
        "The Date is empty or the format entered is incorrect.";
      message1.style.color = "red";
      return false;
    }

  return true;
}

// Función para limpiar los mensajes de validación
function clearValidationMessages() {
  var messages = [
      "message1", 
  ];
  
  messages.forEach(function(messageId) {
      var messageElement = document.getElementById(messageId);
      if (messageElement) {
          messageElement.textContent = "";
          messageElement.style.color = ""; // Restablece el color al valor por defecto
      }
  });
}

//Metodo Ajax

$(document).ready(function () {
  // Cargar el select de proyectos
  $.ajax({
    url: "handler/projectHistoryHandler.php",
    method: "POST",
    dataType: "json",
    data: { action: "printProject" },
    success: function (data) {
      data.forEach(function (item) {
        $("#selectProject").append(
          `<option value="${item.id}">${item.name}</option>`
        );
      });
    },
  });

  // Cargar el select de usuarios
  $.ajax({
    url: "handler/projectHistoryHandler.php",
    method: "POST",
    dataType: "json",
    data: { action: "printUser" },
    success: function (data) {
      data.forEach(function (item) {
        $("#selectUser").append(
          `<option value="${item.id}">${item.username}</option>`
        );
      });
    },
  });

  // Configuración de Date Picker
  jQuery("#datepicker").datepicker({
    autoclose: true,
    minViewMode: 0,
    format: "yyyy-mm-dd",
    todayHighlight: true,
    startDate: "2000-01-01",
  });

  // Inicializar DataTable
  var projectHistoryTable = $("#historyTable").DataTable({
    ajax: {
      url: "handler/projectHistoryHandler.php",
      method: "POST",
      data:  {action: "printTable"},
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
    //initComplete hace algo por defecto cuando la tabla cargue
    initComplete: function () {
      //instancia la api para ejecutar los metodos en el resto del codigo
      var search = this.api();

      // Recorre cada columna para hacer la búsqueda
      search.columns().every(function () {
        var column = this;

        // Verifica que el select tenga algún valor en esa columna
        if ($(column.header()).find("select").length > 0) {
          // Si tiene un valor, se activa un evento change que es para cambiar dependiendo del valor en el select
          $("select", column.header()).on("change", function () {
            // escapeRegex es una función de dataTable que sirve para ignorar cualquier caracter especial en la búsqueda
            // fn.dataTable es la forma en que se accede a las funcionalidades y utilidades del plugin DataTables.
            // util nombre del acceso para entrar en las utilidades
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            // Val si hay un valor va a filtrarlo en base a eso y con draw redibuja la tabla. Si no hay nada, la vuelve a dejar como
            // originalmente estaba
            // true significa que la búsqueda es un patrón irregular
            // false signficia que no debe ser sensible a mayúsculas y minúsculas
            column.search(val ? "^" + val + "$" : "", true, false).draw();
          });
        }
      });
    }
  });

  // Evento de búsqueda
  $("#search").on("click", function (e) {
    e.preventDefault();

    var formData = {
      projectId: $("#selectProject").val(),
      userId: $("#selectUser").val(),
      status: $("#selectAction").val(),
      date: $("#datepicker").val(),
      action: "search",
    };

          //Validar campos vacíos y contenido adecuado
          if (!validateData(formData)) {
            return false;
          }

    // Enviar la solicitud de búsqueda por separado
    $.ajax({
      url: 'handler/projectHistoryHandler.php',
      method: 'POST',
      dataType: 'json',
      data: formData,
      success: function (json) {
        if (json.status === "success") 
        {
          //limpia la tabla con clear, luego selecciona con rows las columnas y dibuja el la data del json con la propiedad draw()
          projectHistoryTable.clear().rows.add(json.data).draw();
          $("#filterDataModal").modal("hide");
          $("#searchData")[0].reset();
          clearValidationMessages();
        } 
        else if (response.status === "error") 
        {
            $("#createTask")[0].reset();
            $("#createTaskmodal").modal("hide");
            clearValidationMessages();
            $("body").html('<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' + response.message + '</div>'); 
         } 
      },
      error: function (xhr, status, error) {
        console.error("Error: ", error);
      }
    });
  });

  // Rea=carga los datos del Datatable
  $("#reloadTable").on("click", function () 
  { 
    projectHistoryTable.ajax.reload(); 
  });


});





  


  
