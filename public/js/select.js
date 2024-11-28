//Exportar Funciones desde aqui al resto del codigo por el servidor

export function initializeSelect(modalId, selectId, url, action) {
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


