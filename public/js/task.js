function validation(event) {
  var char = String.fromCharCode(event.which);
  if (!/^[a-zA-Z0-9\s\W]+$/.test(char)) {
    event.preventDefault();
    return false;
  }
  return true;
}

function validationPicker(event) {
  var char = String.fromCharCode(event.which);
  if (!/^[0-9\s-]+$/.test(char)) {
    event.preventDefault();
    return false;
  }
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  var description = formData.description;
  var date = formData.date;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");
  var message2 = document.getElementById("message2");

  var descriptionRegex = /^[a-zA-Z0-9\s\W]{4,}$/;
  var dateRegex = /^[0-9-]{1,10}$/;

  if (descriptionRegex.test(description)) {
    message1.textContent = " ";
    // message1.style.color = "green";
    $("#description").css({
      border: "3px solid green",
    });
  } else {
    removeBorder("description");
    message1.textContent =
      "The description must contain at least 4 characters.";
    message1.style.color = "red";
    return false;
  }

  if (dateRegex.test(date)) {
    message2.textContent = "Date is valid";
    message2.style.color = "green";
  } else {
    message2.textContent =
      "The Date is empty or the format entered is incorrect.";
    message2.style.color = "red";
    return false;
  }

  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateDataedit(dataEdit) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var description = dataEdit.description.trim();
  var date = dataEdit.date;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("messageEdit1");
  var message2 = document.getElementById("messageEdit2");

  var descriptionRegex = /^[a-zA-Z0-9\s\W]+$/;
  var dateRegex = /^[0-9-]{1,10}$/;
  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (descriptionRegex.test(description)) {
    message1.textContent = " ";
    //message1.style.color = "green";
    $("#descriptionEdit").css({
      border: "3px solid green",
    });
  } else {
    removeBorder("descriptionEdit");
    message1.textContent =
      "The description must contain at least 4 characters.";
    message1.style.color = "red";
    return false;
  }

  if (dateRegex.test(date)) {
    message2.textContent = "Date is valid";
    message2.style.color = "green";
  } else {
    message2.textContent =
      "The Date is empty or the format entered is incorrect.";
    message2.style.color = "red";
    return false;
  }

  return true;
}

//Remueve el border
function removeBorder(elementId) {
  $("#" + elementId).css("border", "");
}

// Función para limpiar los mensajes de validación
function clearValidationMessages() {
  var messages = ["message1", "message2", "messageEdit1", "messageEdit2"];
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
    format: "yyyy-mm-dd", //formato de fecha
    todayHighlight: true, //Este parámetro hace que el día actual se destaque en el calendario.
    startDate: new Date(), //solo toma la fecha apartir del dia de hoy en adelante
  });

  //Data Picker
  jQuery("#datepickerEdit").datepicker({
    autoclose: true,
    minViewMode: 0,
    format: "yyyy-mm-dd",
    todayHighlight: true,
    startDate: new Date(),
  });

   // Manejar evento de mostrar modal para cargar la data
  $("#createTaskModal").on("shown.bs.modal", function () {
    // Inicializar Select2 
    $("#projectTeam").select2({
      dropdownParent: $("#createTaskModal"),
    });

    // Cargar los proyectos a seleccionar
    $.ajax({
      url: "handler/taskHandler.php",
      method: "POST",
      dataType: "json",
      data: { action: "printOptionsProject" },
      success: function (data) {
        projectData = data; // Asignar los datos recibidos a la variable projectData

        // Agregar opciones de proyectos al select de proyectos
        data.forEach(function (project) {
          var projectOption = `<option value="${project.id}">${project.name}</option>`;
          $("#projectTeam").append(projectOption);
        });

        // Primera carga por defecto
        if (data.length > 0) {
          var firstProjectUsers = data[0].users;
          var userSelect = $("#assignerUser");
          userSelect.empty(); // Limpiar la lista de usuarios

          firstProjectUsers.forEach(function (user) {
            var userOption = `<option value="${user.id}">${user.username}</option>`;
            userSelect.append(userOption);
          });

          // Inicializar Select2 después de agregar opciones
          userSelect
            .select2({
              dropdownParent: $("#createTask"),
            })
            .trigger("change")
            .on("select2:open", function () {
              // Forzar reposicionamiento del dropdown
              const select2Position = $(this)
                .data("select2")
                .$dropdown.offset();
              const select2Height = $(this)
                .data("select2")
                .$dropdown.outerHeight();
              $(this)
                .data("select2")
                .$dropdown.css({
                  top: select2Position.top + select2Height,
                });
            });
        }

        // Detectar cambio en la selección de proyecto para cargar usuarios
        $("#projectTeam").change(function () {
          var projectId = $(this).val();
          var selectedProject = projectData.find(
            (project) => project.id == projectId
          );

          if (selectedProject && selectedProject.users) {
            var userSelect = $("#assignerUser");
            userSelect.empty(); // Limpiar la lista de usuarios

            selectedProject.users.forEach(function (user) {
              var userOption = `<option value="${user.id}">${user.username}</option>`;
              userSelect.append(userOption);
            });

            // Inicializar Select2 después de agregar opciones
            userSelect
              .select2({
                dropdownParent: $("#createTask"),
              })
              .trigger("change")
              .on("select2:open", function () {
                // Forzar reposicionamiento del dropdown
                const select2Position = $(this)
                  .data("select2")
                  .$dropdown.offset();
                const select2Height = $(this)
                  .data("select2")
                  .$dropdown.outerHeight();
                $(this)
                  .data("select2")
                  .$dropdown.css({
                    top: select2Position.top + select2Height,
                  });
              });
          } else {
            console.error("No users found for the selected project");
          }
        });
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
      },
    });
  });



  //IMPRIMIR  proyectos con su usuario correspondiente en el editar
  var projectData = []; // Variable para almacenar los datos de proyectos

      // Manejar evento de mostrar modal para cargar la data
  $("#editTaskModal").on("shown.bs.modal", function () {
    // Inicializar Select2 
    $("#projectTeamEdit").select2({
      dropdownParent: $("#editTaskModal"),
    });

    // Cargar los proyectos a seleccionar
    $.ajax({
      url: "handler/taskHandler.php",
      method: "POST",
      dataType: "json",
      data: { action: "printOptionsProject" },
      success: function (data) {
        projectData = data; // Asignar los datos recibidos a la variable projectData

        // Agregar opciones de proyectos al select de proyectos
        data.forEach(function (project) {
          var projectOption = `<option value="${project.id}">${project.name}</option>`;
          $("#projectTeamEdit").append(projectOption);
        });

        // Primera carga por defecto
        if (data.length > 0) {
          var firstProjectUsers = data[0].users;
          var userSelect = $("#assignerUserEdit");
          userSelect.empty(); // Limpiar la lista de usuarios

          firstProjectUsers.forEach(function (user) {
            var userOption = `<option value="${user.id}">${user.username}</option>`;
            userSelect.append(userOption);
          });

          // Inicializar Select2 después de agregar opciones
          userSelect
            .select2({
              dropdownParent: $("#editTask"),
            })
            .trigger("change")
            .on("select2:open", function () {
              // Forzar reposicionamiento del dropdown
              const select2Position = $(this)
                .data("select2")
                .$dropdown.offset();
              const select2Height = $(this)
                .data("select2")
                .$dropdown.outerHeight();
              $(this)
                .data("select2")
                .$dropdown.css({
                  top: select2Position.top + select2Height,
                });
            });
        }

        // Detectar cambio en la selección de proyecto para cargar usuarios
        $("#projectTeamEdit").change(function () {
          var projectId = $(this).val();
          var selectedProject = projectData.find(
            (project) => project.id == projectId
          );

          if (selectedProject && selectedProject.users) {
            var userSelect = $("#assignerUserEdit");
            userSelect.empty(); // Limpiar la lista de usuarios

            selectedProject.users.forEach(function (user) {
              var userOption = `<option value="${user.id}">${user.username}</option>`;
              userSelect.append(userOption);
            });

            // Inicializar Select2 después de agregar opciones
            userSelect
              .select2({
                dropdownParent: $("#editTask"),
              })
              .trigger("change")
              .on("select2:open", function () {
                // Forzar reposicionamiento del dropdown
                const select2Position = $(this)
                  .data("select2")
                  .$dropdown.offset();
                const select2Height = $(this)
                  .data("select2")
                  .$dropdown.outerHeight();
                $(this)
                  .data("select2")
                  .$dropdown.css({
                    top: select2Position.top + select2Height,
                  });
              });
          } else {
            console.error("No users found for the selected project");
          }
        });
      },
      error: function (xhr, status, error) {
        console.error("AJAX error:", error);
      },
    });
  });

  //Imprimir Tabla
  var taskTable = $("#taskTable").DataTable({
    ajax: {
      url: "handler/taskHandler.php",
      method: "POST",
      data: { action: "printTable" },
    },
    columnDefs: [
      { visible: false, targets: 2 },
      { visible: false, targets: 7 },
      { visible: false, targets: 9 },
      { visible: false, targets: 10 },
      { visible: false, targets: 11 },
      {
        targets: 5,
        orderData: [5],
        render: function (data, type, row) {
          var priorityOrder = {
            Low: 1,
            Medium: 2,
            High: 3,
          };
          return type === "sort" ? priorityOrder[data] : data;
        },
      },
      {
        targets: 6,
        orderData: [6],
        render: function (data, type, row) {
          var completedOrder = {
            Pending: 1,
            Completed: 2,
          };
          return type === "sort" ? completedOrder[data] : data;
        },
      },
      //Define que le maximo de caracteres visible sean 30
      {
        targets: 3,
        render: function (data, type, row) {
          if (type === "display") {
            return data.length > 30 ? data.substr(0, 30) + "..." : data;
          }
          return data;
        },
      },
    ],
    columns: [
      { data: "id" },
      { data: "project" },
      { data: "project_id" },
      { data: "description" },
      { data: "due_date" },
      { data: "priority" },
      { data: "completed" },
      { data: "assigned_user_id" },
      { data: "assigned" },
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
  $("#registerTask")
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
          if (response.status === "errorDescription") {
            removeBorder("description");
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorDate") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorUser") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "error") {
            $("#createTask")[0].reset();
            $("#createTaskmodal").modal("hide");
            clearValidationMessages();
            $("body").html(
              '<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' +
                response.message +
                "</div>"
            );
          } else if (response.status === "success") {
            //si funciona entonces procede a guardar el codigo
            alert("Se ha Creado un Nuevo Projecto");
            $("#createTask")[0].reset();
            $("#id").val("");
            $("#createTaskModal").modal("hide");
            removeBorder("description");
            clearValidationMessages();
            loadTable();
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          var errorMessage = "An unexpected error occurred: " + textStatus;

          if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
            errorMessage = jqXHR.responseJSON.message;
          } else if (jqXHR.responseText) {
            try {
              var jsonResponse = JSON.parse(jqXHR.responseText);
              errorMessage = jsonResponse.message || errorMessage;
            } catch (e) {
              errorMessage = jqXHR.responseText;
            }
          }

          // Mapear los patrones de error a los campos del formulario
          var errorMapping = [
            {
              pattern: /Data too long for column 'description'/,
              message: "The data for the description is too long.",
              field: "message1",
            },
            {
              pattern: /Duplicate entry '[^']+' for key '[^']+'/,
              message: "Duplicate entry error.",
              field: "message1",
            },
            {
              pattern: /Unknown column '[^']+' in 'field list'/,
              message: "Unknown column in the field list.",
              field: "message1",
            },
          ];
          removeBorder("description");
          var matched = false;
          for (var i = 0; i < errorMapping.length; i++) {
            var errorPattern = errorMapping[i].pattern;
            if (errorMessage.match(errorPattern)) {
              errorMessage = errorMapping[i].message;
              $("#" + errorMapping[i].field)
                .text(errorMessage)
                .show()
                .css("color", "red");
              matched = true;
              break;
            }
          }
        },
      });
    });

  // Editar por fila a través de una Modal
  $("#taskTable tbody").on("click", "tr", function () {
    // Manejador de Eventos de la tabla Usuarios seleccionando el Tbody
    var data = taskTable.row(this).data(); // selecciona la fila y la retorna la data que se seleccionó como un objeto

    // cada uno retorna la data en el input o select referenciando la columna
    $("#editId").val(data.id);
    $("#projectTeamEdit").val(data.project_id);
    $("#descriptionEdit").val(data.description);
    $("#datepickerEdit").val(data.due_date);
    $("#priorityEdit").val(data.priority);
    // Transformar el valor de "completed"
    var completedValue = data.completed === "Completed" ? "1" : "0";
    $("#taskStatusEdit").val(completedValue);
    // Cargar los usuarios del proyecto seleccionado
    var selectedProject = projectData.find(
      (project) => project.id == data.project_id
    );
    var userSelect = $("#assignerUserEdit");
    userSelect.empty();
    // Limpiar la lista de usuarios
    if (selectedProject) {
      selectedProject.users.forEach(function (user) {
        var userOption = `<option value="${user.id}">${user.username}</option>`;
        userSelect.append(userOption);
      });
      // Seleccionar el usuario asignado
      $("#assignerUserEdit").val(data.assigned_user_id);
    }
    // Mostrar la modal
    $("#editTaskModal").modal("show");
  });

  //Click al Boton para mandar el formulario con los nuevos datos
  $("#editButtonTask")
    .off()
    .click(function (e) {
      e.preventDefault();
      var dataEdit = {
        id: $("#editId").val(),
        projectId: $("#projectTeamEdit").val(),
        description: $("#descriptionEdit").val().trim(),
        date: $("#datepickerEdit").val(),
        priority: $("#priorityEdit").val(),
        completed: $("#taskStatusEdit").val(),
        assigner: $("#assignerUserEdit").val(),
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
          if (response.status === "errorEditDescription") {
            removeBorder("descriptionEdit");
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorEditDate") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorEdit") {
            $("#editTask")[0].reset();
            $("#editTaskModal").modal("hide");
            clearValidationMessages();
            $("body").html(
              '<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' +
                response.message +
                "</div>"
            );
          } else if (response.status === "errorUser") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "success") {
            //si funciona entonces procede a guardar el codigo
            alert("Se ha Modificado un Projecto");
            $("#editTask")[0].reset();
            $("#editTaskModal").modal("hide");
            removeBorder("descriptionEdit");
            clearValidationMessages();
            loadTable();
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          var errorMessage = "An unexpected error occurred: " + textStatus;

          if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
            errorMessage = jqXHR.responseJSON.message;
          } else if (jqXHR.responseText) {
            try {
              var jsonResponse = JSON.parse(jqXHR.responseText);
              errorMessage = jsonResponse.message || errorMessage;
            } catch (e) {
              errorMessage = jqXHR.responseText;
            }
          }

          // Mapear los patrones de error a los campos del formulario
          var errorMapping = [
            {
              pattern: /Data too long for column 'description'/,
              message: "The data for the description is too long.",
              field: "messageEdit1",
            },
            {
              pattern: /Duplicate entry '[^']+' for key '[^']+'/,
              message: "Duplicate entry error.",
              field: "messageEdit1",
            },
            {
              pattern: /Unknown column '[^']+' in 'field list'/,
              message: "Unknown column in the field list.",
              field: "messageEdit1",
            },
          ];
          removeBorder("descriptionEdit");
          var matched = false;
          for (var i = 0; i < errorMapping.length; i++) {
            var errorPattern = errorMapping[i].pattern;
            if (errorMessage.match(errorPattern)) {
              errorMessage = errorMapping[i].message;
              $("#" + errorMapping[i].field)
                .text(errorMessage)
                .show()
                .css("color", "red");
              matched = true;
              break;
            }
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
        id: $("#editId").val(),
        action: "deleteTask",
      };

      $.ajax({
        url: "handler/taskHandler.php",
        dataType: "json",
        type: "POST",
        data: deleteTask,
        success: function (response) {
          if (response.status === "errorDelete") {
            var message = response.message;
            alert("No se pudo Eliminar el Usuario debido: " + message);
            $("#deleteModal").modal("hide");
          } else if (response.status === "success") {
            alert("Se ha Eliminado un Project");
            $("#deleteModal").modal("hide");
            loadTable();
          }
        },
      });
    });
});
