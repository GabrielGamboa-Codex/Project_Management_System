//Importa la funcion del select desde el servidor
//atravez del archivo select.js
import {initializeSelect} from "./select.js";

function validation(event) {
    var char = String.fromCharCode(event.which);
    if (!/[a-zA-Z0-9\s@#$%*+-.]/.test(char)) {
        event.preventDefault();
        return false;
    }
    return true;
}

// Añade un evento de escucha a un campo de texto para utilizar la función de validación
document.querySelector('#userName').addEventListener('keypress', validation);
document.querySelector('#userEmail').addEventListener('keypress', validation);
document.querySelector('#editName').addEventListener('keypress', validation);
document.querySelector('#editEmail').addEventListener('keypress', validation);

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
  var emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

  //revisa que el password tenga al menos 1 mayuscula 1 numero y 1 caracter especial en el password y que tenga como minimo 8 caracteres y maximo 16
  //W_ sirve para decir que permita al menos 1 caracater especial
  var passRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(userName)) {
    message1.textContent = "User is valid";
    message1.style.color = "green";
  } else {
    message1.textContent =
      "The field cannot be empty and must contain at least 4 characters which can be numbers or letters.";
    message1.style.color = "red";
    return false;
  }

  if (emailRegex.test(email)) {
    message2.textContent = "Email is valid";
    message2.style.color = "green";
  } else {
    message2.textContent =
      "The Email field must not be empty and must contain the @ and example .gmail";
    message2.style.color = "red";
    return false;
  }

  if (passRegex.test(pass)) {
    message3.textContent = "Email is valid";
    message3.style.color = "green";
  } else {
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

  //revisa que el userName tenga algun caracter y como minomo sean 4
  var nameRegex = /^[a-zA-Z0-9\s]{4,}$/;

  //Valida que al menos que un @
  var emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

  //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
  if (nameRegex.test(userName)) {
    message1.textContent = "User is valid";
    message1.style.color = "green";
  } else {
    message1.textContent =
      "The field cannot be empty and must contain at least 4 characters which can be numbers or letters.";
    message1.style.color = "red";
    return false;
  }

  if (emailRegex.test(email)) {
    message2.textContent = "Email is valid";
    message2.style.color = "green";
  } else {
    message2.textContent =
      "The Email field must not be empty and must contain the @ and example .gmail";
    message2.style.color = "red";
    return false;
  }

  return true;
}

//Mostrar el Password al hacer click al icono
var passCreate = document.getElementById("userPass");
var passEdit = document.getElementById("editPass");
var icon1 = document.querySelector(".toggle-password");
var icon2 = document.querySelector(".toggle-password2");

//Cuando el Icono haga click hacer
icon1.addEventListener("click", (e) => {
  if (passCreate.type === "password") {
    //Cambio el tipo de input
    passCreate.type = "text";
    //Remuevo la clase del Icono
    icon1.classList.remove("bi-eye-slash");
    //Añado la clase al icono
    icon1.classList.add("bi-eye");
  } else {
    //Cambio el tipo de input
    passCreate.type = "password";
    //Remuevo la clase del Icono
    icon1.classList.remove("bi-eye");
    //Añado la clase al icono
    icon1.classList.add("bi-eye-slash");
  }
});

icon2.addEventListener("click", (e) => {
  if (passEdit.type === "password") {
    passEdit.type = "text";
    icon2.classList.remove("bi-eye-slash");
    icon2.classList.add("bi-eye");
  } else {
    passEdit.type = "password";
    icon2.classList.remove("bi-eye");
    icon2.classList.add("bi-eye-slash");
  }
});

// Función para limpiar los mensajes de validación
function clearValidationMessages() {
  var messages = [
    "message1",
    "message2",
    "message3",
    "message4",
    "messageEdit1",
    "messageEdit2",
    "messageEdit3",
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


//Funcion para inicializar y llamar al Select2 para crear un proyecto
initializeSelect("#createUserModal","#selectTeam","handler/userHandler.php","printOptions");

  var userTable = $("#userTable").DataTable({
    processing: true,  // Muestra un mensaje de procesamiento durante las operaciones
    serverSide: true,  // Habilita el procesamiento del lado del servidor
    ajax: {
      url: "handler/userHandler.php",
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
      { data: "username" },
      { data: "email" },
      { data: "team_id" },
      // Incluye esta columna si la necesitas
      { data: "team" },
      { data: "created_at" },
      { data: "updated_at" },
      { data: "status" },
    ],
  });

 
  // Añade un cursor pointer a todas las filas de la tabla
  $("#userTable tbody").on("mouseenter", "tr", function () {
    $(this).addClass("pointer");
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
        userName: $("#userName").val().trim(),
        email: $("#userEmail").val().toLowerCase(),
        pass: $("#userPass").val(),
        team_id: $("#selectTeam").val(),
        action: "createUser",
      };

      //Validar campos vacíos y contenido adecuado
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
          if (response.status === "errorUser") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorEmail") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorPass") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorSelect") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#message4").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "error") {
            $("#createUser")[0].reset();
            $("#createUserModal").modal("hide");
            clearValidationMessages();
            $("body").html(
              '<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' +
                response.message +
                "</div>"
            );
          } else if (response.status === "success") {
            //si funciona entonces procede a guardar el codigo
            //Alert the Sweet Alert2
            Swal.fire("Success!", "Se ha Creado un nuevo Usuario Exitosamente!", "success");
            $("#createUser")[0].reset();
            // Resetear el select y asignar placeholder 
            $("#selectTeam").val("").trigger('change'); 
            $("#selectTeam").append('<option value="" disabled selected>Select an option</option>');
            $("#id").val("");
            $("#createUserModal").modal("hide");
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
    $("#editId").val(data.id);
    $("#editName").val(data.username);
    $("#editEmail").val(data.email);
    // Inicializar Select2 antes de mostrar el modal
    initializeSelect("#editUserModal", "#teamEdit", "handler/userHandler.php", "printOptions");
      
    // Asegurarse de que el select se inicializa correctamente con el valor predefinido
    $("#teamEdit").empty().append(new Option(data.team, data.team_id, true, true)).trigger('change');
    //empty para asegurar que el select este vacio
    //con New option agrega una opcion por defecto donde data.tema es el texto que va a selecionar el select2
    //team_id es el id seleccionado los true se ponen para que cargue ambos valores por defecto
    //change para que cualquier logica ligada al select se ejecute correctamente
    $("#editUserModal").modal("show"); //muestra la modal
  });

  //Click al Boton para mandar el formulario con los nuevos datos
  $("#editButton")
    .off()
    .click(function (e) {
      e.preventDefault();
      var dataEdit = {
        id: $("#editId").val(),
        userName: $("#editName").val().trim(),
        email: $("#editEmail").val().toLowerCase(),
        pass: $("#editPass").val(),
        teamId: $("#teamEdit").val(),
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
          if (response.status === "errorEditUser") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit1").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorEditEmail") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit2").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "errorEditPass") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "red");
          } else if (response.status === "successEditPass") {
            //selecciono el id mensaje y luego cambio su valor por el texto del json
            var message = $("#messageEdit3").text(response.message).show();
            //con esta propiedad cambio su color a rojo
            message.css("color", "green");
          } else if (response.status === "errorEdit") {
            //si funciona entonces procede a guardar el codigo
            $("#editUser")[0].reset();
            $("#editUserModal").modal("hide");
            clearValidationMessages();
            $("body").html(
              '<div style="color: red;">A critical error has occurred and the page cannot continue. Error: ' +
                response.message +
                "</div>"
            );
          } else if (response.status === "success") {
            //si funciona entonces procede a guardar el codigo
            Swal.fire("Success!", "Se ha Editado el Usuario Exitosamente!", "success");
            $("#editUserModal").modal("hide");
            loadTable();
            $("#editUser")[0].reset();
            clearValidationMessages();
          }
        },
      });
    });

// Mi modal de Sweet alert para eliminar
  document.getElementById('deleteUserButton').addEventListener('click', function() {
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
              var deleteUser = {
                  id: $("#editId").val(),
                  action: "deleteUser",
              };
              //Se ejecuta el ajax que manda la peticion para borrar el usuario
              $.ajax({
                  url: "handler/userHandler.php",
                  dataType: "json",
                  type: "POST",
                  data: deleteUser,
                  success: function (response) {
                      if (response.status === "errorDelete") {
                          var message = response.message;
                          Swal.fire("Error", "Failed to Delete User due to " + message, "error");
                      } else if (response.status === "success") {
                          Swal.fire({
                              title: "Deleted!",
                              text: "El Usuario ha sido Borrado Existosamente.",
                              icon: "success"
                          });
                          $("#editUserModal").modal("hide");
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
