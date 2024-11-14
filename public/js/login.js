//Mostrar el Password al hacer click al icono
var passLogin = document.getElementById("loginPass");
var icon = document.querySelector(".toggle-password");

//Cuando el Icono haga click hacer
icon.addEventListener("click", (e) => 
{
  if (passLogin.type === "password") 
  {
    //Cambio el tipo de input
    passLogin.type = "text";
    //Remuevo la clase del Icono
    icon.classList.remove("bi-eye-slash");
    //Añado la clase al icono
    icon.classList.add("bi-eye");
  } 
  else 
  {
    //Cambio el tipo de input
    passLogin.type = "password";
    //Remuevo la clase del Icono
    icon.classList.remove("bi-eye");
    //Añado la clase al icono
    icon.classList.add("bi-eye-slash");
  }
});

//Validaciones inputs
function validation(event) 
{
  var char = String.fromCharCode(event.which);
  if (!/[a-zA-Z0-9\s+@#$%*-.,]/.test(char)) 
  {
    event.preventDefault();
    return false;
  }
  return true;
}

//Validacion del codigo
function validationCode(event) 
{
  var char = String.fromCharCode(event.which);
  if (!/[0-9]/.test(char)) 
  {
    event.preventDefault();
    return false;
  }
  return true;
}

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
  //Con el .trim valida que los campos no tengas espacios al principio o al final
  var email = formData.email;
  var pass = formData.pass;
  //Llama a los div para que carguen los mensajes si hay algun error
  var message1 = document.getElementById("message1");
  var message2 = document.getElementById("message2");

  //Valida que al menos que un @
  var emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;

  //revisa que el password tenga al menos 1 mayuscula 1 numero y 1 caracter especial en el password y que tenga como minimo 8 caracteres y maximo 16
  //W_ sirve para decir que permita al menos 1 caracater especial
  var passRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,16}$/;

  if (emailRegex.test(email)) 
  {
    message1.textContent = "Email is valid";
    message1.style.color = "green";
  } 
  else 
  {
    message1.textContent =
      "The Email field must not be empty and must contain the @ and example gmail.com";
    message1.style.color = "red";
    return false;
  }

  if (passRegex.test(pass)) 
  {
    message2.textContent = "Password is valid";
    message2.style.color = "green";
  } 
  else 
  {
    message2.textContent =
      "The password must have at least one capital letter, one number and one special character and must contain at least 8 characters and a maximum of 16 characters.";
    message2.style.color = "red";
    moveIcon2();
    return false;
  }

  return true;
}

// Función para limpiar los mensajes de validación
function clearValidationMessages() 
{
  var messages = 
  ["message1",
   "message2", 
   "message3"];
  //Ejecuta esta funcion para cada uno de los id encontrados en el Array
  messages.forEach(function (id) 
  {
    var messageElement = document.getElementById(id);
    //si el mensaje existe en el DOM hacer
    if (messageElement) 
    {
      messageElement.textContent = "";
    }
  });
}

//Borra la cuenta regresiva
function clearCount() 
{
  var countdownElement = document.getElementById("countdown");
  if (countdownElement) 
  {
    countdownElement.textContent = "";
  }
}

//Esconde el input para ingresar el codigo
function showInput() 
{
  var input = document.getElementById("codeValidate");
  input.classList.remove("hidden");
}

// Función para mostrar el segundo mensaje y mover el icono
function moveIcon() {
  var icon = document.getElementById("icon");
  // Mover el icono hacia arriba
  icon.classList.add("move-up");
}

function moveIcon2() {
  var icon = document.getElementById("icon");
  // Mover el icono hacia arriba
  icon.classList.add("move-up2");
}



//Ajax
$(document).ready(function () {
  //Login
  $("#Btnlogin").click(function (e) 
  {
    e.preventDefault();
    var formData = {
      email: $("#loginEmail").val(),
      pass: $("#loginPass").val(),
      code: $("#codeValidate").val(),
      action: "login",
    };

    //Validar campos vacíos y contenido adecuado
    if (!validateData(formData)) 
    {
      return false;
    }

    $.ajax({
      url: "handler/loginHandler.php",
      type: "POST",
      dataType: "json",
      data: formData,
      success: function (response) {
        if (response.status === "errorEmail") 
        {
          //selecciono el id mensaje y luego cambio su valor por el texto del json
          var message = $("#message1").text(response.message).show();
          //con esta propiedad cambio su color a rojo
          message.css("color", "red");
        } 
        else if (response.status === "errorPass")
        {
          //selecciono el id mensaje y luego cambio su valor por el texto del json
          var message = $("#message2").text(response.message).show();
          //con esta propiedad cambio su color a rojo
          message.css("color", "red");
          moveIcon();
        } 
        else if (response.status === "locked") 
        {
          clearValidationMessages();
          //selecciono el id mensaje y luego cambio su valor por el texto del json
          var message = $("#message2").text(response.message).show();
          //con esta propiedad cambio su color a rojo
          message.css("color", "red");
          moveIcon();
        } 
        else if (response.status === "success") 
        {
          showInput();
          //selecciono el id mensaje y luego cambio su valor por el texto del json
          var message = $("#message3").text(response.message).show();
          // Establece el tiempo de cuenta regresiva en 5 minutos (300 segundos)
          var countdownTime = 300; // 5 minutos en segundos

          var countdownElement = document.getElementById("countdown");
          //Funcion para ahcer una cuenta regresiva de 5 minutos
          function updateCountdown() {
            var minutes = Math.floor(countdownTime / 60);
            var seconds = countdownTime % 60;

            // Añadir un cero delante de los segundos si son menos de 10
            seconds = seconds < 10 ? "0" + seconds : seconds;

            countdownElement.innerHTML = minutes + "m " + seconds + "s";

            if (countdownTime > 0) {
              countdownTime--;
            } else {
              countdownElement.innerHTML = "Time expired Try Again";
              clearInterval(countdownInterval);
            }
          }
          // Actualizar la cuenta regresiva cada segundo
          var countdownInterval = setInterval(updateCountdown, 1000);
          updateCountdown(); // Llamar inmediatamente para inicializar la cuenta regresiva
          message.css("color", "blue");
          moveIcon();
        } 
        else if (response.status === "errorCode") 
        {
          //selecciono el id mensaje y luego cambio su valor por el texto del json
          var message = $("#message3").text(response.message).show();
          //con esta propiedad cambio su color a rojo
          message.css("color", "red");
        } 
        else if (response.status === "expired") 
        {
          clearCount();
          //selecciono el id mensaje y luego cambio su valor por el texto del json
          var message = $("#message3").text(response.message).show();
          //con esta propiedad cambio su color a rojo
          message.css("color", "red");
        } 
        else if (response.status === "successTotal") 
        {
          //window propiedad global de js que representa la ventana del navegador
          //location es una propiedad del objeto window que contiene información sobre la URL actual del documento y
          //también se puede usar para redirigir el navegador a una nueva URL.
          //href es una propiedad del objeto location. Puedes pensar en ella como la dirección URL a la que el navegador está apuntando.
          window.location.href = "index.php?action=userView";
          clearValidationMessages();
        }     
      },
    });
  });
});
