function validationPicker(event) {
  var char = String.fromCharCode(event.which);
  if (!/^[0-9\s-]+$/.test(char)) {
    event.preventDefault();
    return false;
  }
  return true;
}

// Función para limpiar los mensajes de validación
function clearValidationMessages() {
  var messages = ["message1"];

  messages.forEach(function (messageId) {
    var messageElement = document.getElementById(messageId);
    if (messageElement) {
      messageElement.textContent = "";
      messageElement.style.color = ""; // Restablece el color al valor por defecto
    }
  });
}

//Metodo Ajax

$(document).ready(function () {

  var projectData = []; // Variable para almacenar los datos de proyectos

    // Manejar evento de mostrar modal para cargar la data
  $("#filterDataModal").on("shown.bs.modal", function () {
    $.ajax({
      url: "handler/projectHistoryHandler.php",
      method: "POST",
      dataType: "json",
      data: { action: "printOptionsProject" },
      success: function (data) {
        //console.log('Data received from server:', data); // Debugging: Verificar datos recibidos
        // Asignar datos de proyectos a projectData \
        projectData = data;
        // Asegúrate de que data sea un array válido
        if (data && Array.isArray(data)) {
          // Vaciar opciones previas
          $("#selectProject")
            .empty()
            .append('<option value="">Select</option>');
          // Agregar opciones de proyecto al select de proyectos
          data.forEach(function (project) {
            var projectOption = `<option value="${project.id}">${project.name}</option>`;
            $("#selectProject").append(projectOption);
          });

          // Verificar que las opciones se hayan agregado correctamente
          //console.log('Options in #selectProject:', $('#selectProject').html());

          // Inicializar Select2 después de agregar opciones
          $("#selectProject").select2({
            dropdownParent: $("#filterDataModal"),
            //Asegura que el dropdown de Select2 se renderiza dentro del modal, lo cual es útil para evitar problemas de superposición.
          });
        } else {
          console.error("Invalid data format", data);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
      },
    });
    // Detectar cambio en la selección de proyecto para cargar usuarios
    $("#selectProject").change(function () {
      var projectId = $(this).val();
      var selectedProject = projectData.find(
        (project) => project.id == projectId
      ); // Usar projectData en lugar de data

      if (selectedProject && selectedProject.users) {
        var userSelect = $("#selectUser");
        userSelect.empty(); // Limpiar la lista de usuarios

        selectedProject.users.forEach(function (user) {
          var userOption = `<option value="${user.id}">${user.username}</option>`;
          userSelect.append(userOption);
        });

        // Inicializar Select2 para el select de usuarios después de agregar opciones
        userSelect
          .select2({
            dropdownParent: $("#filterDataModal"),
          })
          .trigger("change");
      } else {
        console.error("No users found for the selected project");
      }
    });
  });

  // Configuración de Date Picker para fecha de inicio
  jQuery("#startDate").datepicker({
    autoclose: true,
    minViewMode: 0,
    format: "yyyy-mm-dd",
    todayHighlight: true,
    startDate: "2000-01-01",
  });

  // Configuración de Date Picker para fecha de fin
  jQuery("#endDate").datepicker({
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
      data: { action: "printTable" },
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
      dateStart: $("#startDate").val(),
      dateEnd: $("#endDate").val(),
      action: "search",
    };

    // Enviar la solicitud de búsqueda por separado
    $.ajax({
      url: "handler/projectHistoryHandler.php",
      method: "POST",
      dataType: "json",
      data: formData,
      success: function (json) {
        if (json.status === "success") 
        {
          //limpia la tabla con clear, luego selecciona con rows las columnas y dibuja el la data del json con la propiedad draw()
          projectHistoryTable.clear().rows.add(json.data).draw();
          // Limpiar las opciones excepto la opción "Select"
          // filtra las opciones exceptuando la primera
          $("#selectUser").html('<option value="">Select</option>');
          $("#filterDataModal").modal("hide");
          $("#searchData")[0].reset();
        } 
        else if (response.status === "error") 
        {
          $("#searchData")[0].reset();
          $("#filterDataModal").modal("hide");
          clearValidationMessages();
          $("body").html(
            '<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' +
              response.message +
              "</div>"
          );
        }
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", error);
        console.error("Respuesta del servidor:", xhr.responseText);
      },
    });
  });

  // Rea=carga los datos del Datatable
  $("#reloadTable").on("click", function () {
    projectHistoryTable.ajax.reload();
  });
});
