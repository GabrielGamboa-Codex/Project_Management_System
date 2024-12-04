//Importa la funcion del select desde el servidor
//atravez del archivo select.js

import { dataSearch } from "./select.js";

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
  //Carga la data para el select de Busqueda
  dataSearch(
    "#filterDataModal",
    "#selectProject",
    "#selectUser",
    "handler/projectHistoryHandler.php",
    "printOptionsProject"
  );

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
    processing: true,
    serverSide: true,
    search: false,
    ajax: {
      url: "handler/projectHistoryHandler.php",
      method: "POST",
      data: function (d) {
        d.action = "printTable";
        d.projectId = $("#selectProject").val();
        d.userId = $("#selectUser").val();
        d.status = $("#selectAction").val();
        d.dateStart = $("#startDate").val();
        d.dateEnd = $("#endDate").val();
      },
    },
    columnDefs: [
      { visible: false, targets: 1 },
      { visible: false, targets: 4 },
    ],
    //oculta el imput de search del dataTable
    dom: 'lrtip',
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
    projectHistoryTable.ajax.reload(null, false); // Recargar la tabla con los nuevos parámetros
    $("#filterDataModal").modal("hide");
    $("#selectUser").html('<option value="">Select</option>');
    $("#searchData")[0].reset();
  });

  // Recarga los datos del DataTable
  $("#reloadTable").on("click", function () {
    projectHistoryTable.ajax.reload();
  });
});
