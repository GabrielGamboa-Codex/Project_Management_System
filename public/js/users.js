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
  var userName = formData.userName.trim();
  var email = formData.email.trim();
  var pass = formData.pass.trim();
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");
  var message2 = document.getElementById("message2");
  var message3 = document.getElementById("message3");
 

  //revisa que el userName tenga algun caracter y como minomo sean 4
  var nameRegex = /^[a-zA-Z0-9\s]{4,}$/;

//Valida que al menos que un @
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  //revisa que el password tenga al menos 1 mayuscula 1 numero y 1 caracter especial en el password y que tenga como minimo 8 caracteres y maximo 16
  //W_ sirve para decir que permita al menos 1 caracater especial
  var passRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(userName)) {
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
  
  if (emailRegex.test(email)) {
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

  if (passRegex.test(pass)) {
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
  var userName = formData.userName.trim();
  var email = formData.email.trim();
  var pass = formData.pass.trim();
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");
  var message2 = document.getElementById("message2");
  var message3 = document.getElementById("message3");
 

  //revisa que el userName tenga algun caracter y como minomo sean 4
  var nameRegex = /^[a-zA-Z0-9]{4,}$/

//Valida que al menos que un @
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  
  //revisa que el password tenga al menos 1 mayuscula 1 numero y 1 caracter especial en el password y que tenga como minimo 8 caracteres y maximo 16
  var passRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@#$%*]).{8,16}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(userName)) {
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
  
  if (emailRegex.test(email)) {
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

  if (passRegex.test(pass)) {
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
  var userName = dataEdit.userName.trim();
  var email = dataEdit.email.trim();
  var pass = dataEdit.pass.trim();
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("messageEdit1");
  var message2 = document.getElementById("messageEdit2");
  var message3 = document.getElementById("messageEdit3");
 

  //revisa que el userName tenga algun caracter y como minomo sean 4
  var nameRegex = /^[a-zA-Z0-9]{4,}$/

//Valida que al menos que un @
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(userName)) {
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
  
  if (emailRegex.test(email)) {
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
//Cargar un select por ajax enviado la data desde la base de datos
  $.ajax({ 
    url: 'handler/userHandler.php', 
    method: 'POST', 
    dataType: 'json', 
    data: { action: "printOptions" },
    success: function(data) 
    { data.forEach(function(item) 
      { $('#user_team').append(`<option value="${item.id}">${item.name}</option>`); 
    }); 
  },
});

$.ajax({ 
  url: 'handler/userHandler.php', 
  method: 'POST', 
  dataType: 'json', //Tipo de datos que se espera recibir como respuesta.
  data: { action: "printOptions" },
  success: function(data) 
  { data.forEach(function(item)  //Recorre cada elemento en el array de datos recibido como respuesta.
    { $('#team_edit').append(`<option value="${item.id}">${item.name}</option>`); //Añade contenido al final de los elemento seleccionados
  }); 
},
});




  var userTable = $("#userTable").DataTable({
    ajax: {
      url: "handler/userHandler.php",
      method: "POST",
      data: { action: "printTable" }, // Con data envio un action el cual envia un valor llamado printTable
    },
    columnDefs: [ 
      { "visible": false, "targets": 3 }, 
      { "visible": false, "targets": 5 }, 
      { "visible": false, "targets": 6 } 
    ],// srive para ocultar la columna señalada tomando el cuenta que la primera columna es 0
    columns: [
      { data: "id" },
      { data: "username" },
      { data: "email" },
      { data: "team_id" },
       // Incluye esta columna si la necesitas
      { data: "team" },
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
        userName: $("#user_name").val().trim(),
        email: $("#user_email").val().toLowerCase(),
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
        dataType: "json",
        data: formData,
        success: function (response) {
          //si la respuesta es error para el submit y no guarda los datos y envia algo por pantalla
          //reponse comprueba el el https_response_ en el envio
          if (response.status === 400 && response.method === 'errorUser') 
            { 
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#message1").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color","red");
            } 
            else if (response.status === 400 && response.method === 'errorEmail') 
            { 
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#message2").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color","red");
            }
            else if(response.status === 400 && response.method === 'ERROR') //si funciona entonces procede a guardar el codigo
            { 
              console.log("Entre")
              $("#create_user")[0].reset();
              $("#createUsermodal").modal("hide");
              clearValidationMessages();
              $('body').html('<div style="color: red;">Se produjo un error crítico y la página no puede continuar. Error: '.text(response.message).show());
            }  
            else if(response.status === 200 && response.method=== 'success') //si funciona entonces procede a guardar el codigo
            { 
              alert('Usuario creado con éxito.'); 
              console.log(formData)
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
          if (response.status === 400 && response.method === 'errorEditUser') 
            { 
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#messageEdit1").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color","red");
            } 
            else if (response.status === 400 && response.method === 'errorEditEmail') 
            { 
              //selecciono el id mensaje y luego cambio su valor por el texto del json
              var message = $("#messageEdit2").text(response.message).show();
              //con esta propiedad cambio su color a rojo
              message.css("color","red");
            }
            else if(response.status === 400 && response.method === 'ERRORedit') //si funciona entonces procede a guardar el codigo
            { 
              console.log("Entre")
              $("#create_user")[0].reset();
              $("#createUsermodal").modal("hide");
              clearValidationMessages();
              $('body').html('<div style="color: red;">Se produjo un error crítico y la página no puede continuar. Error: '.text(response.message).show());
            } 
            else if(response.status === 200 && response.method === 'success') //si funciona entonces procede a guardar el codigo
            { 
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
