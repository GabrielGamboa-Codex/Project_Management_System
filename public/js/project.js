//Importa la funcion del select desde el servidor
//atravez del archivo select.js

import { initializeSelect } from "./select.js";


//Validaciones
function validation(event) {
  var char = String.fromCharCode(event.which);
  if (!/^[a-zA-Z0-9\s\W]+$/.test(char)) {
    event.preventDefault();
    return false;
  }
  return true;
}

// Añade un evento de escucha a un campo de texto para utilizar la función de validación
document.querySelector('#projectName').addEventListener('keypress', validation);
document.querySelector('#projectDescription').addEventListener('keypress', validation);
document.querySelector('#editNameProject').addEventListener('keypress', validation);
document.querySelector('#descriptionEdit').addEventListener('keypress', validation);


// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var name = formData.name;
  var description = formData.description;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");
  var message2 = document.getElementById("message2");


  //revisa que el name tenga algun caracter y como minomo sean 4
  var nameRegex = /^[a-zA-Z0-9\s\W]{4,}$/;

  //Valida que al menos que un @
  var descriptionRegex = /^[a-zA-Z0-9\s\W]{4,}$/;


  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(name)) {
    message1.textContent = "Name is valid";
    message1.style.color = "green";
  }
  else {
    message1.textContent = "The name cannot contain special characters, only letters or numbers and must contain at least 4 characters.";
    message1.style.color = "red";
    return false;
  }

  if (descriptionRegex.test(description)) {
    message2.textContent = " ";
    // message2.style.color = "green";
    $('#projectDescription').css({
      'border': '3px solid green'
    });
  }
  else {
    message2.textContent =
      "The description must contain at least 4 characters";
    message2.style.color = "red";
    removeBorder('projectDescription');
    return false;
  }


  return true;
}


// Verificar que el campo no esté vacío y contenga letras
function validateDataedit(dataEdit) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var name = dataEdit.name.trim();
  var description = dataEdit.description;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("messageEdit1");
  var message2 = document.getElementById("messageEdit2");

  //revisa que el name tenga algun caracter y como minomo sean 4
  var nameRegex = /^[a-zA-Z0-9\s\W]{4,}$/;

  //Valida que al menos que un @
  var descriptionRegex = /^[a-zA-Z0-9\s\W]{4,}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(name)) {
    message1.textContent = "Name is valid";
    message1.style.color = "green";
  }
  else {
    message1.textContent =
      "The project name must contain numeric characters or letters and be at least 4 characters long.";
    message1.style.color = "red";
    return false;
  }

  if (descriptionRegex.test(description)) {
    message2.textContent = " ";
    // message2.style.color = "green";
    $('#descriptionEdit').css({
      'border': '3px solid green'
    });
  }
  else {
    message2.textContent =
      "The description must contain at least 4 characters";
    message2.style.color = "red";
    removeBorder('descriptionEdit');
    return false;
  }

  return true;
}


// Función para limpiar los mensajes de validación
function clearValidationMessages() {
  var messages = [
    "message1",
    "message2",
    "message3",
    "messageEdit1",
    "messageEdit2",
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

//Remueve el border
function removeBorder(elementId) {
  $('#' + elementId).css('border', '');
}




//Metodo Ajax

$(document).ready(function () {
  //Tabla de Projectos
  var projectTable = $("#projectTable").DataTable({
    ajax: {
      url: "handler/projectHandler.php",
      method: "POST",
      data: { action: "printTable" }, // Con data envio un action el cual envia un valor llamado printTable
    },
    columnDefs: [
      { visible: false, targets: 3 },
      { visible: false, targets: 5 },
      { visible: false, targets: 6 },
      { visible: false, targets: 7 },
      //Define que le maximo de caracteres visible sean 30
      {
        //selecciono la columna
        targets: 2,
        //renderizado para la columna
        render: function (data, type, row) {
          if (type === 'display') {
            //subtrare los primeros 30 caracteres y luego lo demas le suma un ... que es lo que va a ver el usuario
            return data.length > 30 ? data.substr(0, 30) + '...' : data;
          }
          return data;
        }
      }

    ], // sirve para ocultar la columna señalada tomando el cuenta que la primera columna es 0
    columns: [
      { data: "id" },
      { data: "name" },
      { data: "description" },
      { data: "team_id" },
      // Incluye esta columna si la necesitas
      { data: "team" },
      { data: "created_at" },
      { data: "updated_at" },
      { data: "status" },
    ],
  });

  // Añade un cursor pointer a todas las filas de la tabla
  $("#projectTable tbody").on("mouseenter", "tr", function () {
    $(this).addClass("pointer");
  });


  // funcion para recargar la tabla
  function loadTable() {
    projectTable.ajax.reload();
  }

  //Funcion para inicializar y llamar al Select2 para crear un proyecto
  initializeSelect("#createProjectModal", "#projecTeam", "handler/projectHandler.php", "printOptions");

  // Crear  Proyecto
  $("#registerProject")
    .off()
    .click(function (e) {
      e.preventDefault();
      var formData = {
        id: $("#id").val(),
        name: $("#projectName").val().trim(),
        description: $("#projectDescription").val().trim(),
        teamId: $("#projecTeam").val(),
        action: "createProject",
      };

      //Validar campos vacíos y contenido adecuado
      if (!validateData(formData)) {
        return false;
      }

      $.ajax({
        url: "handler/projectHandler.php",
        type: "POST",
        dataType: "json",
        data: formData,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //reponse comprueba el el https_response_ en el envio
          if (response.status === "errorProject") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          }
          else if (response.status === "errorDescription") {
            removeBorder('projectDescription');
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          }
          else if (response.status === "errorSelect") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          }
          else if (response.status === "error") {
            $("#createProject")[0].reset();
            $("#createProjectModal").modal("hide");
            clearValidationMessages();
            $("body").html('<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' + response.message + '</div>');
          }
          else if (response.status === "success") {
            //si funciona entonces procede a guardar el codigo
            Swal.fire("Success!", "Se ha Creado un nuevo Projecto Exitosamente!", "success");
            $("#createProject")[0].reset();
            $("#id").val("");
            $("#createProjectModal").modal("hide");
            removeBorder('projectDescription');
            clearValidationMessages();
            loadTable();
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          //inicializa un error generico
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
            { pattern: /Data too long for column 'description'/, message: "The data for the description is too long.", field: "message2" },
            { pattern: /Duplicate entry '[^']+' for key '[^']+'/, message: "Duplicate entry error.", field: "message2" },
            { pattern: /Unknown column '[^']+' in 'field list'/, message: "Unknown column in the field list.", field: "message2" },
            { pattern: /Data too long for column 'name'/, message: "The data for the project name is too long.", field: "message1" },
          ];
          removeBorder('projectDescription');
          var matched = false;
          for (var i = 0; i < errorMapping.length; i++) {
            var errorPattern = errorMapping[i].pattern;
            if (errorMessage.match(errorPattern)) {
              errorMessage = errorMapping[i].message;
              $("#" + errorMapping[i].field).text(errorMessage).show().css("color", "red");
              matched = true;
              break;
            }
          }
        }
      });
    });




  // Evento de clic en la tabla para mostrar los datos en el modal
  $("#projectTable tbody").on("click", "tr", function () {
    var data = projectTable.row(this).data();
    $("#editId").val(data.id);
    $("#editNameProject").val(data.name);
    $("#descriptionEdit").val(data.description);

    // Inicializar Select2 antes de mostrar el modal
    initializeSelect("#editProjectModal", "#projecTeamEdit", "handler/projectHandler.php", "printOptions");

    // Asegurarse de que el select se inicializa correctamente con el valor predefinido
    $("#projecTeamEdit").empty().append(new Option(data.team, data.team_id, true, true)).trigger('change');
    //empty para asegurar que el select este vacio
    //con New option agrega una opcion por defecto donde data.tema es el texto que va a selecionar el select2
    //team_id es el id seleccionado los true se ponen para que cargue ambos valores por defecto
    //change para que cualquier logica ligada al select se ejecute correctamente
    $("#editProjectModal").modal("show");
  });


  //Click al Boton para mandar el formulario con los nuevos datos
  $("#editButtonProject")
    .off()
    .click(function (e) {
      e.preventDefault();
      var dataEdit = {
        id: $("#editId").val(),
        name: $("#editNameProject").val().trim(),
        description: $("#descriptionEdit").val(),
        teamId: $("#projecTeamEdit").val(),
        action: "editProject",
      };

      // Validar campos vacíos y contenido adecuado
      if (!validateDataedit(dataEdit)) {
        return false;
      }

      $.ajax({
        url: "handler/projectHandler.php",
        type: "POST",
        dataType: "json",
        data: dataEdit,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //reponse comprueba el el https_response_ en el envio
          if (response.status === "errorEditProject") {
            removeBorder('descriptionEdit');
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          }
          else if (response.status === "errorEditDescription") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          }
          else if (response.status === "errorEdit") {
            $("#editProject")[0].reset();
            $("#editProjectModal").modal("hide");
            clearValidationMessages();
            $("body").html('<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' + response.message + '</div>');
          }
          else if (response.status === "success") {
            //si funciona entonces procede a guardar el codigo
            Swal.fire("Success!", "Se ha Editado el Projecto Exitosamente!", "success");
            $("#editProject")[0].reset();
            $("#editProjectModal").modal("hide");
            removeBorder('descriptionEdit');
            clearValidationMessages();
            loadTable();
          }
        },
        //jqXHR: El objeto jqXHR (abreviatura de jQuery XML HTTP Request) que representa la respuesta de la solicitud AJAX.
        //textStatus: Una cadena que describe el tipo de error que ocurrió (por ejemplo, "timeout", "error", "abort", "parsererror").
        //errorThrown: Un objeto que contiene el error lanzado por la solicitud.
        error: function (jqXHR, textStatus, errorThrown) {

          //inicializa un error generico
          var errorMessage = "An unexpected error occurred: " + textStatus;

          //analiza si el mensaje del json y repuesta del json existen o tienen valores
          if (jqXHR.responseJSON && jqXHR.responseJSON.message) {
            //reescribes el valor del error mensaje por el mensaje del json
            errorMessage = jqXHR.responseJSON.message;
            //si el respose text exista analiza el json y cambia el mensaje o reescribe el mensaje
          } else if (jqXHR.responseText) {
            try {
              var jsonResponse = JSON.parse(jqXHR.responseText);
              errorMessage = jsonResponse.message || errorMessage;
            } catch (e) {
              errorMessage = jqXHR.responseText;
            }
          }

          // Mapear los patrones de error a los campos del formulario
          //haciendo una lista de objetos que define a través de expresiones regulares a mensajes de error específicos y campos de formulario a los cuales.
          //se les asigna dicho error
          var errorMapping = [
            { pattern: /Data too long for column 'description'/, message: "The data for the description is too long.", field: "messageEdit2" },
            { pattern: /Duplicate entry '[^']+' for key '[^']+'/, message: "Duplicate entry error.", field: "messageEdit2" },
            { pattern: /Unknown column '[^']+' in 'field list'/, message: "Unknown column in the field list.", field: "messageEdit2" },
            { pattern: /Data too long for column 'name'/, message: "The data for the project name is too long.", field: "messageEdit1" },
          ];
          removeBorder('descriptionEdit');
          var matched = false;
          //verifica que el error maping coincidad con algun patron definido
          for (var i = 0; i < errorMapping.length; i++) {
            var errorPattern = errorMapping[i].pattern;
            if (errorMessage.match(errorPattern)) {
              errorMessage = errorMapping[i].message;
              //si conincide con un patron manda el error al campo especifico y rompe el bucle
              $("#" + errorMapping[i].field).text(errorMessage).show().css("color", "red");
              matched = true;
              break;
            }
          }
        }
      });
    });


  // Mi modal de Sweet alert para eliminar
  document.getElementById('deleteButtonProject').addEventListener('click', function () {
    Swal.fire({
      title: "Estas seguro?",
      text: "No vas a poder Revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        // Aquí se ejecuta la lógica para eliminar el usuario
        var deleteProject = {
          id: $("#editId").val(),
          action: "deleteProject",
        };
        //Se ejecuta el ajax que manda la peticion para borrar el usuario
        $.ajax({
          url: "handler/projectHandler.php",
          dataType: "json",
          type: "POST",
          data: deleteProject,
          success: function (response) {
            if (response.status === "errorDelete") {
              var message = response.message;
              Swal.fire("Error", "Failed to Delete User due to " + message, "error");
            } else if (response.status === "success") {
              Swal.fire({
                title: "Deleted!",
                text: "El Projecto ha sido Borrado Existosamente.",
                icon: "success"
              });
              $("#editProjectModal").modal("hide");
              clearValidationMessages();
              loadTable();
            }
          },
          error: function (xhr, status, error) {
            Swal.fire("Error", "An error occurred: " + error, "error");
          }
        });
      }
    });
  });

});