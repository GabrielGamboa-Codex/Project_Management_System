//Validaciones
function validation(event) {
  var char = String.fromCharCode(event.which);
  if (!/[a-zA-Z0-9\s@#$%*.]/.test(char)) {
    event.preventDefault();
    return false;
  }
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var username = formData.username.trim();
  var email = formData.email.trim();
  var pass = formData.pass.trim();
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");
  var message2 = document.getElementById("message2");
  var message3 = document.getElementById("message3");
 

  //revisa que el username tenga algun caracter y como minomo sean 4
  var nameregex = /^[a-zA-Z0-9\s]{4,}$/;

//Valida que al menos que un @
  var emailregex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  //revisa que el password tenga al menos 1 mayuscula 1 numero y 1 caracter especial en el password y que tenga como minimo 8 caracteres y maximo 16
  var passregex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%*]).{8,16}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameregex.test(username)) {
    message1.textContent =
    "User is valid";
    message1.style.color = "green";
  }
  else{
    message1.textContent =
    "The field cannot be empty and must contain at least 4 characters.";
    message1.style.color = "red";
    return false;
  }
  
  if (emailregex.test(email)) {
    message2.textContent =
    "Email is valid";
    message2.style.color = "green";
  }
  else{
    message2.textContent =
    "The Email field must not be empty and must contain the @ and example .gmail";
    message2.style.color = "red";
    return false;
  }

  if (passregex.test(pass)) {
    message3.textContent =
      "Email is valid";
    message3.style.color = "green";
  }
  else{
    message3.textContent =
      "The password must have at least one capital letter, one number and one special character and must contain at least 8 characters and a maximum of 16 characters.";
    message3.style.color = "red";
    return false;
  }

  
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var username = formData.username.trim();
  var email = formData.email.trim();
  var pass = formData.pass.trim();
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");
  var message2 = document.getElementById("message2");
  var message3 = document.getElementById("message3");
 

  //revisa que el username tenga algun caracter y como minomo sean 4
  var nameregex = /^[a-zA-Z0-9]{4,}$/

//Valida que al menos que un @
  var emailregex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  //revisa que el password tenga al menos 1 mayuscula 1 numero y 1 caracter especial en el password y que tenga como minimo 8 caracteres y maximo 16
  var passregex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%*]).{8,16}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameregex.test(username)) {
    message1.textContent =
    "User is valid";
    message1.style.color = "green";
  }
  else{
    message1.textContent =
    "The field cannot be empty and must contain at least 4 characters which can be numbers or letters.";
    message1.style.color = "red";
    return false;
  }
  
  if (emailregex.test(email)) {
    message2.textContent =
    "Email is valid";
    message2.style.color = "green";
  }
  else{
    message2.textContent =
    "The Email field must not be empty and must contain the @ and example .gmail";
    message2.style.color = "red";
    return false;
  }

  if (passregex.test(pass)) {
    message3.textContent =
      "Password is valid";
    message3.style.color = "green";
  }
  else{
    message3.textContent =
      "The password must have at least one capital letter, one number and one special character and must contain at least 8 characters and a maximum of 16 characters.";
    message3.style.color = "red";
    return false;
  }

  
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateDataedit(dataEdit) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var username = dataEdit.username.trim();
  var email = dataEdit.email.trim();
  var pass = dataEdit.pass.trim();
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("messageEdit1");
  var message2 = document.getElementById("messageEdit2");
  var message3 = document.getElementById("messageEdit3");
 

  //revisa que el username tenga algun caracter y como minomo sean 4
  var nameregex = /^[a-zA-Z0-9]{4,}$/

//Valida que al menos que un @
  var emailregex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  //revisa que el password tenga al menos 1 mayuscula 1 numero y 1 caracter especial en el password y que tenga como minimo 8 caracteres y maximo 16
  var passregex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%*]).{8,16}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameregex.test(username)) {
    message1.textContent =
    "User is valid";
    message1.style.color = "green";
  }
  else{
    message1.textContent =
    "The field cannot be empty and must contain at least 4 characters which can be numbers or letters.";
    message1.style.color = "red";
    return false;
  }
  
  if (emailregex.test(email)) {
    message2.textContent =
    "Email is valid";
    message2.style.color = "green";
  }
  else{
    message2.textContent =
    "The Email field must not be empty and must contain the @ and example .gmail";
    message2.style.color = "red";
    return false;
  }
  
  return true;
}

// Función para limpiar los mensajes de validación
function clearValidationMessages() {
  var messages = ["message1", "message2", "message3", "messageEdit1", "messageEdit2", "messageEdit3"];
  //Ejecuta esta funcion para cada uno de los id encontrados en el Array
  messages.forEach(function(id) {
    var messageElement = document.getElementById(id);
    //si el mensaje existe en el DOM hacer
    if (messageElement) {
      messageElement.textContent = "";
    }
  });
}

//Metodo Ajax
$(document).ready(function () {
  var userTable = $("#userTable").DataTable({
    ajax: {
      url: "handler/userHandler.php",
      method: "POST",
      data: { action: "printTable" }, // Con data envio un action el cual envia un valor llamado printTable
    },
    columns: [
      { data: "id" },
      { data: "username" },
      { data: "email" },
      { data: "team_id" }, // Incluye esta columna si la necesitas
      { data: "created_at" },
      { data: "updated_at" },
    ],
  });

  // Añade un cursor pointer a todas las filas de la tabla
  $('#userTable tbody').on('mouseenter', 'tr', function () {
    $(this).addClass('pointer');
});

  // funcion para recargar la tabla
  function loadTable() {
    userTable.ajax.reload();
  }

  // Crear  datos
  $("#registerUser")
    .off()
    .click(function (e) {
      e.preventDefault();
      var formData = {
        id: $("#id").val(),
        username: $("#user_name").val().trim(),
        email: $("#user_email").val(),
        pass: $("#user_pass").val(),
        team_id: $("#user_team").val(),
        action: "createUser",
      };


      // Validar campos vacíos y contenido adecuado
      if (!validateData(formData)) {
        return false;
      }

      $.ajax({
        url: "handler/userHandler.php",
        type: "POST",
        data: formData,
        success: function (response) {
          console.log(formData)
          $("#create_user")[0].reset();
          $("#id").val("");
          $("#createUsermodal").modal("hide");
          alert("Se ha creado un Nuevo registro");
          clearValidationMessages();
          loadTable();
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
        username: $("#edit_name").val().trim(),
        email: $("#edit_email").val(),
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
        data: dataEdit,
        success: function (response) {
          $("#editUsermodal").modal("hide");
          alert("Se ha Actualizado un Registro");
          loadTable();
          clearValidationMessages();
          $("#edit_user")[0].reset();
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
        type: "POST",
        data: deleteUser,
        success: function (response) {
          $("#deleteModal").modal("hide");
          alert("Se ha Eliminado un Registro");
          loadTable();
        },
      });
    });
});
