//Validaciones
function validation(event) {
  var char = String.fromCharCode(event.which);
  if (!/[a-zA-Z0-9\s]/.test(char)) {
    event.preventDefault();
    return false;
  }
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var name = formData.name;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");

  //revisa que el name tenga algun caracter y como minomo sean 4
  var nameRegex = /^[a-zA-Z0-9\s]{4,}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(name)) {
    message1.textContent = "Name is valid";
    message1.style.color = "green";
  } else {
    message1.textContent =
      "The name cannot contain special characters, only letters or numbers and must contain at least 4 characters.";
    message1.style.color = "red";
    return false;
  }

  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateDataedit(dataEdit) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var name = dataEdit.name;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("messageEdit1");

  //revisa que el name tenga algun caracter y como minimo sean 4
  var nameRegex = /^[a-zA-Z0-9\s]{4,}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(name)) {
    message1.textContent = "Name is valid";
    message1.style.color = "green";
  } else {
    message1.textContent =
      "The project name must contain numeric characters or letters and be at least 4 characters long.";
    message1.style.color = "red";
    return false;
  }

  return true;
}

// Función para limpiar los mensajes de validación
function clearValidationMessages() {
  var messages = [
    "message1", 
    "messageEdit1"
    ];
}

//Metodo Ajax

$(document).ready(function () {
    //Tabla de Projectos
    var teamTable = $("#teamTable").DataTable({
      ajax: {
        url: "handler/teamHandler.php",
        method: "POST",
        data: { action: "printTable" }, // Con data envio un action el cual envia un valor llamado printTable
      },
      columnDefs: [
        { visible: false, targets: 2 },
        { visible: false, targets: 3 },
        { visible: false, targets: 4 },
      ], // sirve para ocultar la columna señalada tomando el cuenta que la primera columna es 0
      columns: [
        { data: "id" },
        { data: "name" },
        // Incluye esta columna si la necesitas
        { data: "created_at" },
        { data: "updated_at" },
        { data: "status" },
      ],
    });

      // funcion para recargar la tabla
  function loadTable() {
    teamTable.ajax.reload();
  }

    // Añade un cursor pointer a todas las filas de la tabla
    $("#teamTable tbody").on("mouseenter", "tr", function () {
      $(this).addClass("pointer");
    });
  
  // Crear  Proyecto
  $("#registerTeam")
    .off()
    .click(function (e) {
      e.preventDefault();
      var formData = {
        id: $("#id").val(),
        name: $("#team_Name").val().trim(),
        action: "createTeam",
      };

      //Validar campos vacíos y contenido adecuado
      if (!validateData(formData)) {
        return false;
      }

      $.ajax({
        url: "handler/teamHandler.php",
        type: "POST",
        dataType: "json",
        data: formData,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //reponse comprueba el el https_response_ en el envio
          if (response.status === "errorTeam") 
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } 
          else if (response.status === "ERROR") 
          {
            $("#create_Team")[0].reset();
            $("#createTeammodal").modal("hide");
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
            alert("Se ha Creado un Nuevo Team");
            console.log(formData);
            $("#create_Team")[0].reset();
            $("#id").val("");
            $("#createTeammodal").modal("hide");
            clearValidationMessages();
            loadTable();
          }
        },
      });
    });


  //Editar por fila atravez de una Modal
  $("#teamTable tbody").on("click", "tr", function () {
    //Manejador de Eventos de la tabla Usuarios seleccionando el Tbody
    var data = teamTable.row(this).data(); // selecciona la fila y la retorna la data que se selecciono como un objeto
    // cada uno retorna la data en el input o select referenciando la columnna
    $("#edit_id").val(data.id);
    $("#edit_nameTeam").val(data.name);
    $("#editTeammodal").modal("show"); //muestra la modal
  });

  //Click al Boton para mandar el formulario con los nuevos datos
  $("#editTeamButton")
    .off()
    .click(function (e) {
      e.preventDefault();
      var dataEdit = {
        id: $("#edit_id").val(),
        name: $("edit_nameTeam").val(),
        action: "editTeam",
      };

      // Validar campos vacíos y contenido adecuado
      if (!validateDataedit(dataEdit)) {
        return false;
      }

      $.ajax({
        url: "handler/teamHandler.php",
        type: "POST",
        dataType: "json",
        data: dataEdit,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
         //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //reponse comprueba el el https_response_ en el envio
          if (response.status === "errorEditTeam") 
            {
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#message1").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color", "red");
            } 
            else if (response.status === "ERROR") 
            {
              $("#edit_team")[0].reset();
              $("#editTeammodal").modal("hide");
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
              alert("Se ha Modificado un Team");
              $("#edit_team")[0].reset();
              $("#editTeammodal").modal("hide");
              clearValidationMessages();
              loadTable();
              console.log(dataEdit);
            }
        },
      });
    });

  //Eliminar un Usuario
  $("#deleteTeamButton")
    .off()
    .click(function (e) {
      e.preventDefault();
      var deleteTeam = {
        id: $("#edit_id").val(),
        action: "deleteTeam",
      };

      $.ajax({
        url: "handler/teamHandler.php",
        dataType: "json",
        type: "POST",
        data: deleteTeam,
        success: function (response) {
          if (response.status === "ERRORdelete") 
          {
            var message = $("#message").text(response.message).show();
            alert("No se pudo Eliminar el Usuario debido: " + message);
            $("#deletemodal").modal("hide");
          } 
          else if (response.status === "success") 
          {
            alert("Se ha Eliminado un Team");
            $("#deletemodal").modal("hide");
            loadTable();
          }
        },
      });
    });

});