//Validaciones
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

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
    //Con el .trim valida que los campos no tengas espacios al principio o al final
    var projectName = formData.projectName.trim();
    var description = formData.email.trim();
    //Llama a los div para que carguen los mensajes si hay algun error
    var message1 = document.getElementById("message1");
    var message2 = document.getElementById("message2");

  
    //revisa que el projectName tenga algun caracter y como minomo sean 4
    var nameRegex = /^[a-zA-Z0-9\s]{4,}$/;
  
    //Valida que al menos que un @
    var descriptionRegex = /^[a-zA-Z0-9\s.,;-]{4,}$/;
  

  
    //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
    if (nameRegex.test(projectName)) 
    {
      message1.textContent = "Name is valid";
      message1.style.color = "green";
    }
    else 
    {
      message1.textContent =
        "The name cannot contain special characters, only letters or numbers and must contain at least 4 characters.";
      message1.style.color = "red";
      return false;
    }
  
    if (descriptionRegex.test(email)) 
    {
      message2.textContent = "Description is valid";
      message2.style.color = "green";
    } 
    else 
    {
      message2.textContent =
        "The description must contain at least 4 characters";
      message2.style.color = "red";
      return false;
    }
  
  
    return true;
  }
  
  
  // Verificar que el campo no esté vacío y contenga letras
  function validateDataedit(dataEdit) {
    //Con el .trim valida que los campos no tengas espacios al principio o al final
    var projectName = dataEdit.projectName.trim();
    var description = dataEdit.email.trim();
    //Llama a los div para que carguen los mensajes si hay algun error
    var message1 = document.getElementById("messageEdit1");
    var message2 = document.getElementById("messageEdit2");
  
    //revisa que el projectName tenga algun caracter y como minomo sean 4
    var nameRegex = /^[a-zA-Z0-9]{4,}$/;
  
    //Valida que al menos que un @
    var descriptionRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
    //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
    //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
    if (nameRegex.test(projectName)) 
        {
          message1.textContent = "Name is valid";
          message1.style.color = "green";
        }
        else 
        {
          message1.textContent =
            "The project name must contain numeric characters or letters and be at least 4 characters long.";
          message1.style.color = "red";
          return false;
        }
      
        if (descriptionRegex.test(email)) 
        {
          message2.textContent = "Description is valid";
          message2.style.color = "green";
        } 
        else 
        {
          message2.textContent =
            "The description must contain at least 4 characters";
          message2.style.color = "red";
          return false;
        }
  
    return true;
  }
  
  
  // Función para limpiar los mensajes de validación
  function clearValidationMessages() 
  {
    var messages = [
      "message1",
      "message2",
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

      // funcion para recargar la tabla
  function loadTable() {
    projectTable.ajax.reload();
  }

     //Cargar un select por ajax enviado la data desde la base de datos
  $.ajax({
    url: "handler/projectHandler.php",
    method: "POST",
    dataType: "json",
    data: { action: "printOptions" },
    success: function (data) {
      data.forEach(function (item) {
        $("#project_team").append(
          `<option value="${item.id}">${item.name}</option>`
        );
      });
    },
  });

  $.ajax({
    url: "handler/projectHandler.php",
    method: "POST",
    dataType: "json", //Tipo de datos que se espera recibir como respuesta.
    data: { action: "printOptions" },
    success: function (data) {
      data.forEach(function (
        item //Recorre cada elemento en el array de datos recibido como respuesta.
      ) {
        $("#project_team_edit").append(
          `<option value="${item.id}">${item.name}</option>`
        ); //Añade contenido al final de los elemento seleccionados
      });
    },
  });

  // Crear  Proyecto
  $("#registerProject")
    .off()
    .click(function (e) {
      e.preventDefault();
      var formData = {
        id: $("#id").val(),
        name: $("#project_name").val().trim(),
        description: $("#project_description").val().trim(),
        team_id: $("project_team").val(),
        action: "createUser",
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
          if (response.status === "errorProject") 
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } 
          else if (response.status === "errorDescription") 
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          }
          else if (response.status === "ERROR") 
          {
            $("#create_user")[0].reset();
            $("#createUsermodal").modal("hide");
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
            alert("Usuario creado con éxito.");
            console.log(formData);
            $("#create_user")[0].reset();
            $("#id").val("");
            $("#createUsermodal").modal("hide");
            clearValidationMessages();
            loadTable();
          }
        },
      });
    });

  //Editar por fila atravez de una Modal
  $("#userTable tbody").on("click", "tr", function () {
    //Manejador de Eventos de la tabla Usuarios seleccionando el Tbody
    var data = userTable.row(this).data(); // selecciona la fila y la retorna la data que se selecciono como un objeto
    // cada uno retorna la data en el input o select referenciando la columnna
    $("#edit_id").val(data.id);
    $("#edit_name").val(data.username);
    $("#edit_email").val(data.email);
    $("#team_edit").val(data.team_id);
    $("#editUsermodal").modal("show"); //muestra la modal
  });

  //Click al Boton para mandar el formulario con los nuevos datos
  $("#editButton")
    .off()
    .click(function (e) {
      e.preventDefault();
      var dataEdit = {
        id: $("#edit_id").val(),
        userName: $("#edit_name").val().trim(),
        email: $("#edit_email").val().toLowerCase(),
        pass: $("#edit_pass").val(),
        team_id: $("#team_edit").val(),
        action: "editUser",
      };

      // Validar campos vacíos y contenido adecuado
      if (!validateDataedit(dataEdit)) {
        return false;
      }

      $.ajax({
        url: "handler/userHandler.php",
        type: "POST",
        dataType: "json",
        data: dataEdit,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          if (response.status === "errorEditUser") 
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } 
          else if ( response.status === "errorEditEmail") 
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } 
          else if(response.status === 'errorEditPass')
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          }
          else if ( response.status === 'successEditPass')
          {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "green");
          }
          else if (response.status  === "ERRORedit") 
          {
            //si funciona entonces procede a guardar el codigo
            console.log("Entre");
            $("#create_user")[0].reset();
            $("#createUsermodal").modal("hide");
            clearValidationMessages();
            $("body").html(
              '<div style="color: red;">Se produjo un error crítico y la página no puede continuar. Error: '.text(
                response.message
              )
            );
          } 
          else if (response.status === "success") 
          {
            //si funciona entonces procede a guardar el codigo
            alert("Se ha Actualizado un Registro");
            $("#editUsermodal").modal("hide");
            loadTable();
            clearValidationMessages();
            $("#edit_user")[0].reset();
          }
        },
      });
    });

  //Eliminar un Usuario
  $("#deleteButton")
    .off()
    .click(function (e) {
      e.preventDefault();
      var deleteUser = {
        id: $("#edit_id").val(),
        action: "deleteUser",
      };

      $.ajax({
        url: "handler/userHandler.php",
        dataType: "json",
        type: "POST",
        data: deleteUser,
        success: function (response) {
          if (response.status === "ERRORdelete") 
          {
            var message = $("#message").text(response.message).show();
            alert("No se pudo Eliminar el Usuario debido: " + message);
            $("#deleteModal").modal("hide");
          } 
          else if (response.status === "success") 
          {
            alert("Se ha Eliminado un Registro");
            $("#deleteModal").modal("hide");
            loadTable();
          }
        },
      });
    });

});