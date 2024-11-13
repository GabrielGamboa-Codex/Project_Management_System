


















//Metodo Ajax
$(document).ready(function () { 

   
    
        $("#datepicker").datepicker({
            dateFormat: "yy-mm-dd",  // Ajusta el formato de fecha según tus necesidades
            beforeShow: function(input, inst) //Se utiliza para ajustar la posición del selector de fecha.
            {
                setTimeout(function() //Esto asegura que el cambio de posición se aplique después de que el selector de fecha haya calculado su tamaño y posición por defecto. con un tiempo de retardo de 0 milisegundos.
                {
                    inst.dpDiv.css({
                        //inst es el objeto de instancia del selector de fecha.
                        //dpDiv es la división (div) que contiene el selector de fecha.
                        //css({ ... }) se utiliza para aplicar estilos CSS directamente a esta división.
                        top: $(input).offset().top - inst.dpDiv.outerHeight(),
                        //$(input).offset().top obtiene la posición vertical (en píxeles) del elemento de entrada (input) en relación con la parte superior de la página.
                        left: $(input).offset().left
                        //$(input).offset().left obtiene la posición horizontal (en píxeles) del elemento de entrada en relación con el borde izquierdo de la página.
                    });
                }, 0);
            }
        });

   
  
});