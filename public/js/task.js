function validation(event) 
{
  var char = String.fromCharCode(event.which);
  if (!/[a-zA-Z0-9\s.,;-]/.test(char)) 
  {
    event.preventDefault();
    return false;
  }
  return true;
}

function validationPicker(event) 
{
  var char = String.fromCharCode(event.which);
  if (!/[0-9\s-]/.test(char)) 
  {
    event.preventDefault();
    return false;
  }
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  var description = formData.description;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");

  var descriptionRegex = /^[a-zA-Z0-9\s.,;-]{4,}$/;

  if (descriptionRegex.test(description)) 
  {
    message1.textContent = "Description is valid";
    message1.style.color = "green";
  } 
  else 
  {
    message1.textContent =
      "The description must contain at least 4 characters";
    message1.style.color = "red";
    return false;
  }


  return true;
}


// Verificar que el campo no esté vacío y contenga letras
function validateDataedit(dataEdit) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var description = dataEdit.description.trim();
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("messageEdit1");
 
  var descriptionRegex = /^[a-zA-Z0-9\s.,;-]{4,}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"    
      if (descriptionRegex.test(description)) 
      {
        message1.textContent = "Description is valid";
        message1.style.color = "green";
      } 
      else 
      {
        message1.textContent =
          "The description must contain at least 4 characters";
        message1.style.color = "red";
        return false;
      }

  return true;
}


// Función para limpiar los mensajes de validación
function clearValidationMessages() 
{
  var messages = [
    "message1",
    "messageEdit1",
  ];
  //Ejecuta esta funcion para cada uno de los id encontrados en el Array
  messages.forEach(function (id) {
    var messageElement = document.getElementById(id);
    //si el mensaje existe en el DOM hacer
    if (messageElement) {
      messageElement.textContent = "";
    }
  });
}


//Metodo Ajax
$(document).ready(function () {
  //Data Picker
  jQuery("#datepicker").datepicker({
    autoclose: true, //hace que el calendario se cierre automáticamente después de seleccionar una fecha.
    minViewMode: 0,
    format: "mm-dd-yyyy", //formato de fecha
    todayHighlight: true, //Este parámetro hace que el día actual se destaque en el calendario.
    startDate: new Date(),//solo toma la fecha apartir del dia de hoy en adelante
  });

  //Data Picker
  jQuery("#datepicker_edit").datepicker({
    autoclose: true,
    minViewMode: 0,
    format: "mm-dd-yyyy",
    todayHighlight: true,
    startDate: new Date(),
  });
  
  //Carga los usuarios a seleccionar
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

//carga los projectos a seleccionar
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

    //Carga los usuarios a seleccionar
    $.ajax({
      url: "handler/taskHandler.php",
      method: "POST",
      dataType: "json",
      data: { action: "printOptionsUser" },
      success: function (data) {
        data.forEach(function (item) {
          $("#assignerUserEdit").append(
            `<option value="${item.id}">${item.username}</option>`
          );
        });
      },
    });
  
  //carga los projectos a seleccionar
    $.ajax({
      url: "handler/taskHandler.php",
      method: "POST",
      dataType: "json", //Tipo de datos que se espera recibir como respuesta.
      data: { action: "printOptionsProject" },
      success: function (data) {
        data.forEach(function (
          item //Recorre cada elemento en el array de datos recibido como respuesta.
        ) {
          $("#projectTeamEdit").append(
            `<option value="${item.id}">${item.name}</option>`
          ); //Añade contenido al final de los elemento seleccionados
        });
      },
    });

  var taskTable = $("#taskTable").DataTable({
    ajax: {
      url: "handler/taskHandler.php",
      method: "POST",
      data: { action: "printTable" }, // Con data envio un action el cual envia un valor llamado printTable
    },
    columnDefs: [
      { visible: false, targets: 7 },
      { visible: false, targets: 8 },
      { visible: false, targets: 9 },
    ], // sirve para ocultar la columna señalada tomando el cuenta que la primera columna es 0
    columns: [
      { data: "id" },
      { data: "project_id" },
      { data: "description" },
      { data: "due_date" },
      // Incluye esta columna si la necesitas
      { data: "priority" },
      { data: "completed" },
      { data: "assigned_user_id" },
      { data: "created_at" },
      { data: "updated_at" },
      { data: "status" },
    ],
  });

    // Añade un cursor pointer a todas las filas de la tabla
    $("#taskTable tbody").on("mouseenter", "tr", function () {
      $(this).addClass("pointer");
    });
  
  
  // funcion para recargar la tabla
    function loadTable() {
      taskTable.ajax.reload();
    }

  // Crear  Proyecto
  $("#create_task")
    .off()
    .click(function (e) {
      e.preventDefault();
      var formData = {
        id: $("#id").val(),
        projectId: $("#projectTeam").val().trim(),
        description: $("#description").val().trim(),
        date: $("#datepicker").val(),
        priority: $("#priority").val(),
        completed: $("#taskStatus").val(),
        assigner: $("#assignerUser").val(),
        action: "createTask",
      };

      //Validar campos vacíos y contenido adecuado
      if (!validateData(formData)) {
        return false;
      }

      $.ajax({
        url: "handler/taskHandler.php",
        type: "POST",
        dataType: "json",
        data: formData,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //reponse comprueba el el https_response_ en el envio
          if (response.status === "errorDescription") 
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } 
          else if (response.status === "ERROR") 
          {
            $("#create_task")[0].reset();
            $("#createTaskmodal").modal("hide");
            clearValidationMessages();
            $("body").html(
              '<div style="color: red;">Se produjo un error crítico y la página no puede continuar. Error: '
                .text(response.message)
                .show()
            );
          } 
          else if (response.status === "success") 
          {
            //si funciona entonces procede a guardar el codigo
            alert("Se ha Creado un Nuevo Projecto");
            console.log(formData);
            $("#create_task")[0].reset();
            $("#id").val("");
            $("#createTaskmodal").modal("hide");
            clearValidationMessages();
            loadTable();
          }
        },
      });
    });

  //Editar por fila atravez de una Modal
  $("#taskTable tbody").on("click", "tr", function () {
    //Manejador de Eventos de la tabla Usuarios seleccionando el Tbody
    var data = taskTable.row(this).data(); // selecciona la fila y la retorna la data que se selecciono como un objeto
    // cada uno retorna la data en el input o select referenciando la columnna
    $("#edit_id").val(data.id);
    $("#projectTeamEdit").val(data.project_id);
    $("#descriptionEdit").val(data.description);
    $("#datepickerEdit").val(data.due_date);
    $("#priorityEdit").val(data.priority);
    $("#taskStatusEdit").val(data.completed);
    $("#assignerUserEdit").val(data.assigned_user_id);
    $("#editTaskmodal").modal("show"); //muestra la modal
  });

  //Click al Boton para mandar el formulario con los nuevos datos
  $("#editButtonTask")
    .off()
    .click(function (e) {
      e.preventDefault();
      var dataEdit = {
        id: $("#id").val(),
        projectId: $("#projectTeam").val().trim(),
        description: $("#description").val().trim(),
        date: $("#datepicker").val(),
        priority: $("#priority").val(),
        completed: $("#taskStatus").val(),
        assigner: $("#assignerUser").val(),
        action: "editTask",
      };

      // Validar campos vacíos y contenido adecuado
      if (!validateDataedit(dataEdit)) {
        return false;
      }

      $.ajax({
        url: "handler/taskHandler.php",
        type: "POST",
        dataType: "json",
        data: dataEdit,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
         //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //reponse comprueba el el https_response_ en el envio
            if (response.status === "errorEditDescription") 
            {
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#messageEdit1").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color", "red");
            }
            else if (response.status === "ERROR") 
            {
              $("#edit_Project")[0].reset();
              $("#editProjectmodal").modal("hide");
              clearValidationMessages();
              $("body").html(
                '<div style="color: red;">Se produjo un error crítico y la página no puede continuar. Error: '
                  .text(response.message)
                  .show()
              );
            } 
            else if (response.status === "success") 
            {
              //si funciona entonces procede a guardar el codigo
              alert("Se ha Modificado un Projecto");
              $("#edit_task")[0].reset();
              $("#editTaskmodal").modal("hide");
              clearValidationMessages();
              loadTable();
            }
        },
      });
    });

  //Eliminar un Usuario
  $("#deleteTask")
    .off()
    .click(function (e) {
      e.preventDefault();
      var deleteTask = {
        id: $("#edit_id").val(),
        action: "deleteTask",
      };

      $.ajax({
        url: "handler/taskHandler.php",
        dataType: "json",
        type: "POST",
        data: deleteTask,
        success: function (response) {
          if (response.status === "ERRORdelete") 
          {
            var message = $("#message").text(response.message).show();
            alert("No se pudo Eliminar el Usuario debido: " + message);
            $("#deleteModal").modal("hide");
          } 
          else if (response.status === "success") 
          {
            alert("Se ha Eliminado un Project");
            $("#deleteModal").modal("hide");
            loadTable();
          }
        },
      });
    });

});
