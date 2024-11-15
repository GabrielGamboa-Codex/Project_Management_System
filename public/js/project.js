//Validaciones
function validation(event) 
{
  var char = String.fromCharCode(event.which);
  if (!/^[a-zA-Z0-9\s\W]+$/.test(char)) 
  {
    event.preventDefault();
    return false;
  }
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
    //Con el .trim valida que los campos no tengas espacios al principio o al final
    var name = formData.name;
    var description = formData.description;
    //Llama a los div para que carguen los mensajes si hay algun error
    var message1 = document.getElementById("message1");
    var message2 = document.getElementById("message2");

  
    //revisa que el name tenga algun caracter y como minomo sean 4
    var nameRegex = /^[a-zA-Z0-9\s]{4,}$/;
  
    //Valida que al menos que un @
    var descriptionRegex = /^[a-zA-Z0-9\s\W]+$/;
  

  
    //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
    if (nameRegex.test(name)) 
    {
      message1.textContent = "Name is valid";
      message1.style.color = "green";
    }
    else 
    {
      message1.textContent = "The name cannot contain special characters, only letters or numbers and must contain at least 4 characters.";
      message1.style.color = "red";
      return false;
    }
  
    if (descriptionRegex.test(description)) 
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
    var name = dataEdit.name.trim();
    var description = dataEdit.description;
    //Llama a los div para que carguen los mensajes si hay algun error
    var message1 = document.getElementById("messageEdit1");
    var message2 = document.getElementById("messageEdit2");
  
    //revisa que el name tenga algun caracter y como minomo sean 4
    var nameRegex = /^[a-zA-Z0-9\s]{4,}$/;
  
    //Valida que al menos que un @
    var descriptionRegex = /^.{4,}$/;
  
    //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
    //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
    if (nameRegex.test(name)) 
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
      
        if (descriptionRegex.test(description)) 
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

     //Cargar un select por ajax enviado la data desde la base de datos
  $.ajax({
    url: "handler/projectHandler.php",
    method: "POST",
    dataType: "json",
    data: { action: "printOptions" },
    success: function (data) {
      data.forEach(function (item) {
        $("#projecTeam").append(
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
        $("#projecTeamEdit").append(
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
          else if (response.status === "error") 
          {
            $("#createProject")[0].reset();
            $("#createProjectModal").modal("hide");
            clearValidationMessages();
            $("body").html('<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' + response.message + '</div>'); 
          } 
          else if (response.status === "success") 
          {
            //si funciona entonces procede a guardar el codigo
            alert("Se ha Creado un Nuevo Projecto");
            $("#createProject")[0].reset();
            $("#id").val("");
            $("#createProjectModal").modal("hide");
            clearValidationMessages();
            loadTable();
          }
        },
      });
    });

  //Editar por fila atravez de una Modal
  $("#projectTable tbody").on("click", "tr", function () {
    //Manejador de Eventos de la tabla Usuarios seleccionando el Tbody
    var data = projectTable.row(this).data(); // selecciona la fila y la retorna la data que se selecciono como un objeto
    // cada uno retorna la data en el input o select referenciando la columnna
    $("#editId").val(data.id);
    $("#editNameProject").val(data.name);
    $("#descriptionEdit").val(data.description);
    $("#projecTeamEdit").val(data.team_id);
    $("#editProjectModal").modal("show"); //muestra la modal
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
          if (response.status === "errorEditProject") 
            {
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#message1").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color", "red");
            } 
            else if (response.status === "errorEditDescription") 
            {
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#message2").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color", "red");
            }
            else if (response.status === "errorEdit") 
            {
              $("#editProject")[0].reset();
              $("#editProjectModal").modal("hide");
              clearValidationMessages();
              $("body").html('<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' + response.message + '</div>'); 
            } 
            else if (response.status === "success") 
            {
              //si funciona entonces procede a guardar el codigo
              alert("Se ha Modificado un Projecto");
              $("#editProject")[0].reset();
              $("#editProjectModal").modal("hide");
              clearValidationMessages();
              loadTable();
            }
        },
      });
    });

  //Eliminar un Usuario
  $("#deleteProject")
    .off()
    .click(function (e) {
      e.preventDefault();
      var deleteProject = {
        id: $("#editId").val(),
        action: "deleteProject",
      };

      $.ajax({
        url: "handler/projectHandler.php",
        dataType: "json",
        type: "POST",
        data: deleteProject,
        success: function (response) {
          if (response.status === "errorDelete") 
          {
            var message = response.message;
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