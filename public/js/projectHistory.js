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
  var projectData = []; // Variable para almacenar los datos de proyectos
  
  // Cargar los proyectos a seleccionar
  $.ajax({
    url: "handler/projectHistoryHandler.php",
    method: "POST",
    dataType: "json",
    data: { action: "printOptionsProject" },
    success: function (data) {
      projectData = data; // Asignar los datos recibidos a la variable projectData

      // Agregar opciones de proyectos al select de proyectos
      data.forEach(function (project) {
        var projectOption = `<option value="${project.id}">${project.name}</option>`;
        $("#selectProject").append(projectOption);
      });
    },
  });

  // Detectar cambio en la selección de proyecto para cargar usuarios
  $("#selectProject").change(function () {
    var projectId = $(this).val();
    var selectedProject = projectData.find(project => project.id == projectId); // Usar projectData en lugar de data
    var userSelect = $("#selectUser");
    userSelect.empty(); // Limpiar la lista de usuarios

    if (selectedProject) {
      selectedProject.users.forEach(function (user) {
        var userOption = `<option value="${user.id}">${user.username}</option>`;
        userSelect.append(userOption);
      });
    }
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
          console.log(formData);
          $("#filterDataModal").modal("hide");
          $("#searchData")[0].reset();
        } 
        else if (response.status === "error") 
        {
            $("#createTask")[0].reset();
            $("#createTaskmodal").modal("hide");
            clearValidationMessages();
            $("body").html('<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' + response.message + '</div>'); 
         } 
      },
      error: function (xhr, status, error) 
      { 
        console.error("Error en la solicitud AJAX:", error); 
        console.error("Respuesta del servidor:", xhr.responseText); 
      }
    });
  });

  // Rea=carga los datos del Datatable
  $("#reloadTable").on("click", function () 
  { 
    projectHistoryTable.ajax.reload(); 
  });


});





  


  
