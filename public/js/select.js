//Exportar Funciones desde aqui al resto del codigo por el servidor

export function initializeSelect(modalId, selectId, url, action) {
    //hasclass comprueba si la clase esta asignada
    //"select2-hidden-accessible": Es una clase CSS que Select2 agrega a un elemento select después de que ha sido inicializado. 
    //Esta clase indica que Select2 está activo en este select.
    //permite que cargue la data en el select de ser necesario y no la sobre escriba al inicializarlo
    if (!$(selectId).hasClass("select2-hidden-accessible")) 
    {
    // Manejar evento de mostrar modal para cargar la data
     $(modalId).on("shown.bs.modal", function () {
        // Inicializar Select2
        $(selectId).select2({
            dropdownParent: $(modalId),
            placeholder: "Select an option",
            ajax: {
                url: url,
                method: "POST",
                dataType: "json",
                delay: 250, // Retraso para esperar a que el usuario deje de escribir
                data: function(params) {
                    // Parámetros enviados en la solicitud AJAX
                    return {
                        action: action,
                        q: params.term, // Término de búsqueda
                        page: params.page || 1 // Página actual
                    };
                },
                processResults: function(data, params) {
                    // Parámetros de paginación para Select2
                    params.page = params.page || 1;

                    // Formatear los resultados para Select2
                    var results = data.map(function(item) {
                        return {
                            id: item.id,
                            text: item.name
                        };
                    });

                    // Devolver los resultados y la información de paginación
                    return {
                        results: results,
                        pagination: {
                            more: data.length === 5 // Hay más resultados si se devolvieron 5 elementos
                        }
                    };
                },
                cache: true // Cachear los resultados para mejorar el rendimiento
            },
        });
    });
  }
}

//Carga por defecto la data con la funcion de initialize select y luego la distribuye en base a los ususarios que pertenecen a x projecto
export function initializeProjectAndUser(modalId, projectSelectId, userSelectId, url, action) {
    
        // Inicializar Select2 para el select de proyectos
        initializeSelect(modalId, projectSelectId, url, action);

        //Inicia y caraga la data en la modal para que se cargue el select2 en el Select Users
        $(modalId).on("shown.bs.modal", function () {
        // Inicializar Select2 para el select de usuarios con placeholder
            $(userSelectId).select2({
                //EL DropdownParent evita que el select se abra el cualquier lugary se abra correctamente
                dropdownParent: $(userSelectId).closest('.modal-content'),
                placeholder: "Select an option"
            });
        }),

        // Manejar cambios en la selección del proyecto para cargar usuarios
        $(projectSelectId).on("change", function () {
            var projectId = $(this).val();

            if (projectId) {
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: { action: "printOptionsProject" },
                    success: function (data) {
                        var selectedProject = data.find(project => project.id == projectId);
                        var userSelect = $(userSelectId);
                        userSelect.empty(); // Limpiar la lista de usuarios

                        // Agregar opciones de usuarios al select de usuarios
                        if (selectedProject && selectedProject.users) {
                            selectedProject.users.forEach(function (user) {
                                var userOption = `<option value="${user.id}">${user.username}</option>`;
                                userSelect.append(userOption);
                            });

                            // Actualizar Select2 después de agregar opciones
                            userSelect.trigger('change');
                        } else {
                            // Agregar una opción de "Sin usuarios" si no hay usuarios asignados
                            var noUserOption = `<option value="">No users available</option>`;
                            userSelect.append(noUserOption);
                            userSelect.trigger('change');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error:", error);
                    },
                });
            }
        });
}

export function dataSearch(modalId, projectSelectId, userSelectId, url, projectAction) {
    var projectData = []; // Variable para almacenar los datos de proyectos

    // Manejar evento de mostrar modal para cargar la data
    $(modalId).on("shown.bs.modal", function () {
        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: { action: projectAction },
            success: function (data) {
                projectData = data;

                if (data && Array.isArray(data)) {
                    // Vaciar opciones previas
                    $(projectSelectId)
                        .empty()
                        .append('<option value="">Select</option>');

                    // Agregar opciones de proyecto al select de proyectos
                    data.forEach(function (project) {
                        var projectOption = `<option value="${project.id}">${project.name}</option>`;
                        $(projectSelectId).append(projectOption);
                    });

                    // Inicializar Select2 después de agregar opciones
                    $(projectSelectId).select2({
                        dropdownParent: $(modalId),
                        //Asegura que el dropdown de Select2 se renderiza dentro del modal, lo cual es útil para evitar problemas de superposición.
                    });
                } else {
                    console.error("Invalid data format", data);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", error);
            }
        });

        // Detectar cambio en la selección de proyecto para cargar usuarios
        $(projectSelectId).change(function () {
            var projectId = $(this).val();
            var selectedProject = projectData.find(project => project.id == projectId);

            if (selectedProject && selectedProject.users) {
                var userSelect = $(userSelectId);
                userSelect.empty(); // Limpiar la lista de usuarios

                selectedProject.users.forEach(function (user) {
                    var userOption = `<option value="${user.id}">${user.username}</option>`;
                    userSelect.append(userOption);
                });

                // Inicializar Select2 para el select de usuarios después de agregar opciones
                userSelect
                    .select2({
                        dropdownParent: $(modalId),
                    })
                    .trigger("change");
            } else {
                console.error("No users found for the selected project");
            }
        });
    });
}



