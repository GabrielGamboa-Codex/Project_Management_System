console.log("Hola");



//Validaciones
function validation(event) {
    var char = String.fromCharCode(event.which);
    if (!/[a-zA-Z0-9\s@.]/.test(char)) {
      event.preventDefault();
      return false;
    }
    return true;
  }

// Verificar que el campo no esté vacío y contenga letras
function validateData(formData) {
    //Con el .trim valida que los campos no tengas espacios al principio o al final
    var name = formData.name.trim();
    var email = formData.email.trim();
    var pass = formData.password.trim();
    var team = formData.team;
    var regex = /[a-zA-Z0-9\s@.*]/; // Verifica que contenga al menos una letra
  
    //el .test valida que se cumpra una cadena de una expresion irregular por ejemplo "/[a-zA-Z]/"
    if (!name && !regex.test(name)) {
      alert(
        "El campo Nombre de Usuario no puede estar Vacio y debe contener Informacion."
      );
      return false;
    }
    if (team == 0) {
      alert("El campo de Seleccion de Team no puede estar vacío.");
      return false;
    }
    if (!email && !regex.test(email) && !email.includes('@')) {
      alert(
        "El campo Email no debe estar vacio y debe contener informacion"
      );
      return false;
    }
    if (!pass && !regex.test(pass)) {
        alert(
          "El campo Password no puede estar vacio, Por favor ingrese una Contraseña."
        );
        return false;
      }
    return true;
  }

  //Metodo Ajax
  $(document).ready(function() {
    $('#UserTable').DataTable({
        "ajax": {
            "url": "handler/get_user.php",
            "dataSrc": "data"
        },
        "columns": [
            { "data": "id" },
            { "data": "username" },
            { "data": "email" },
            { "data": "team_id" },  // Incluye esta columna si la necesitas
            { "data": "created_at" },
            { "data": "updated_at" }
        ]
    });
});

          
             