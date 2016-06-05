/* 
 * Funciones con peticiones AJAX y jquery.
 */

// Función principal
$(function () {
    $(document).on("click", "#paginacion > li", function (event) {
        event.preventDefault();
        $("#divMensaje").removeClass("correcto error").addClass("oculto").html("");

        // Si estoy en la misma página que el número del botón que no haga nada.
        var paginaBoton = parseInt($(event.currentTarget).attr("data-pagina"));
        if (parseInt($("#paginacion").attr("data-pagina")) !== paginaBoton) {
            paginar(paginaBoton);
        }

    });
    
    $("#formularioActividad").submit(enviarFormulario);

    $('.datepicker').pickadate({
        selectMonths: true
    });
    
    // Linea para inicializar el menú desplegable para móviles
    $(".button-collapse").sideNav();
    
    // Para el menú desplegable
    $(".dropdown-button").dropdown();
    
    $(document).ready(function () {
        $('.time_element').timepicki({
            show_meridian: false,
            min_hour_value: 0,
            max_hour_value: 23,
            overflow_minutes: true,
            increase_direction: 'up',
            disable_keyboard_mobile: true})
    });

    $("#nuevaActividad").click(function () {
        $("#formularioActividad").trigger("submit", {
            url: "/Controller/partePrivada/actividades/insertarActividad.php"
        });
    });
    $("#modificarActividad").click(function () {
        $("#formularioActividad").trigger("submit", {
            url: "/Controller/partePrivada/actividades/modificarActividad.php"
        });
    });

    $("#cerrarModal").click(function () {
        $("#modalActividad").closeModal();
        $("#formularioActividad").data("idActividad", null);
    });

    $("#suscribirseActividad").click(function () {
        $.ajax({
            url: '/Controller/partePrivada/usuario/miNuevaActividad.php',
            method: 'POST',
            dataType: 'json',
            data: {
                codigo_actividad: $("#modalActividad").data("codigo_actividad"),
            },
            success: function (respuesta, textStatus, jqXHR) {
                if (respuesta.estado) {
                    $("#divMensaje").removeClass("oculto error").addClass("correcto").html("Suscripción realizada con éxito.");
                    setTimeout(function () {
                        $("#divMensaje").removeClass("correcto error").addClass("oculto");
                    }, 3000);
                } else {
                    $("#divMensaje").removeClass("oculto correcto").addClass("error").html("Hubo un error al realizar la suscripción.");
                    setTimeout(function () {
                        $("#divMensaje").removeClass("correcto error").addClass("oculto");
                    }, 3000);
                }

                $("#modalActividad").closeModal();
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    });

    $(document).on("click", "a[data-action='nuevo']", function (event) {
        event.preventDefault();
        mostrarModal({
            accion: "crear"
        });
    });

    $(document).on("click", "a[data-action='detalles']", function (event) {
        event.preventDefault();
        $.ajax({
            url: '/Controller/partePrivada/actividades/detallesActividad.php',
            method: 'GET',
            dataType: 'json',
            data: {
                codigo_actividad: $(event.currentTarget).attr("data-id")
            },
            success: function (respuesta, textStatus, jqXHR) {
                $("#suscribirseActividad").parent().show();
                if (respuesta) {
                    var actividad = $.parseJSON(respuesta.actividad);
                    console.log(actividad);
                    $("#contenedorDetallesActividad").find("div[data-actividad]").each(function (indice, elemento) {
                        var dato = $(elemento).attr("data-actividad");
                        if (actividad[dato] !== "") {
                            $(elemento).text(actividad[dato]);
                        } else {
                            $(elemento).text("-");
                        }
                    });
                    $("#modalActividad").data("codigo_actividad", actividad.codigo_actividad);
                }
                mostrarModal({
                    accion: "ver",
                    participa: respuesta.participa
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            },
        })
    });

    $(document).on("click", "a[data-action='editar']", function (event) {
        event.preventDefault();
        $.ajax({
            url: '/Controller/partePrivada/actividades/detallesActividad.php',
            method: 'GET',
            dataType: "json",
            data: {
                codigo_actividad: $(event.currentTarget).attr("data-id")
            },
            success: function (respuesta, textStatus, jqXHR) {

                // Almacenar la id de la actividad que se ha seleccionado en el formulario
                // Esto se hace para no usar input hidden
                var actividad = JSON.parse(respuesta.actividad);
                $("#formularioActividad").data("idActividad", actividad["codigo_actividad"]);

                // Recogemos los elementos del formulario
                var controlesFormulario = $("#formularioActividad")[0].elements;
                mostrarModal({
                    accion: "modificar"
                });

                // Iteramos por cada elemento del formulario de fin a inicio
                $.each(controlesFormulario, function (index) {
                    var elemento = controlesFormulario[controlesFormulario.length - 1 - index];
                    var nombre = $(elemento).attr("name");
                    // Si el elemento tiene atributo name lo modificamos
                    // Esto lo hacemos para filtrar los elementos que no tengan name como los botones
                    // de submit
                    if (nombre) {
                        $(elemento).val(actividad[nombre]);
                        // Martillazo para que Materialize ponga los labels encima del input
                        $(elemento).trigger("focus");
                    }
                });

            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });

    });

    $(document).on("click", "a[data-action='borrar']", function (event) {
        event.preventDefault();
        $.ajax({
            url: '/Controller/partePrivada/actividades/eliminarActividad.php',
            method: 'POST',
            dataType: "json",
            data: {
                codigo_actividad: $(event.currentTarget).attr("data-id")
            },
            success: function (respuesta, textStatus, jqXHR) {
                if (respuesta.estado) {
                    $("#divMensaje").removeClass("oculto error").addClass("correcto").html("La actividad ha sido eliminada con exito");
                    setTimeout(function () {
                        $("#divMensaje").removeClass("correcto error").addClass("oculto");
                    }, 3000);
                    // Refrescar la tabla
                    paginar($("#paginacion").attr("data-pagina"));
                } else {
                    $("#divMensaje").removeClass("oculto correcto").addClass("error").html("Hubo un problema al borrar la actividad. Por favor inténtelo más tarde");
                    setTimeout(function () {
                        $("#divMensaje").removeClass("correcto error").addClass("oculto");
                    }, 3000);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        });
    });
});

function paginar(pagina) {
    $.ajax({
        url: '/Controller/partePrivada/actividades/gestionActividades.php',
        method: 'GET',
        data: {
            pagina: pagina
        }, success: function (tabla, textStatus, jqXHR) {
            // Petición con éxito
            if (textStatus === "success") {
                $("#contenedorTabla").html(tabla);
            }

        }, error: function (jqXHR, textStatus, errorThrown) {
            // La petición por algún motivo ha fallado
            $("#divMensaje").show().html("Ha habido un error al solicitar los datos, inténtalo más tarde.");
        }
    });
}

function enviarFormulario(event, opciones) {
    event.preventDefault();
    var url;
    var mensaje = $("#divMensaje");

    // Comprobamos que se pase el parámetro opciones siendo un objeto.
    if ($.isPlainObject(opciones) && opciones.url) {
        url = opciones.url;
    }

    // Si no conseguimos la url del controlador salimos de la función
    if (!url) {
        return false;
    }

    var formulario = $("#formularioActividad")[0];
    if (formulario.checkValidity()) {
        var datos = $("#formularioActividad").serializeArray();
        // Creamos un objeto llamado actividad
        var actividad = {};
        //iteramos sobre datos que es un array con todas las propiedades que tiene actividad.
        for (var a = 0; a < datos.length; a++) {
            // creamos una variable propiedad donde le decimos en posición x sacame name.
            var propiedad = datos[a].name;
            // creamos una variable valor donde le decimos en posición x sacame value.
            var valor = datos[a].value;
            // en actividad le añadimos una propiedad y le asignamos un valor.
            actividad[propiedad] = valor;
        }
        // creamos una variable el cual coje la propiedad pickadate y obtenemos el valor con este formato
        var fecha_inicio = $("#fecha_inicio_actividad").pickadate("picker").get("select", "yyyy-mm-dd");
        var fecha_fin = $("#fecha_fin_actividad").pickadate("picker").get("select", "yyyy-mm-dd");
        // obtenemos la propiedad de la hora del objeto de actividad
        var horario_inicio = actividad.horario_inicio;
        var horario_fin = actividad.horario_fin;

        horario_inicio = horario_inicio.split(" ").join("") + ":00";
        horario_fin = horario_fin.split(" ").join("") + ":00";

        actividad.horario_inicio = horario_inicio;
        actividad.horario_fin = horario_fin;

        actividad.fecha_inicio = fecha_inicio;
        actividad.fecha_fin = fecha_fin;


        var id = $("#formularioActividad").data("idActividad");
        if (id) {
            actividad.codigo_actividad = id;
        }
        var errores = validarFormulario(actividad);
        if (errores.length === 0) {

            $.ajax({
                url: url,
                method: 'POST',
                data: actividad,
                dataType: "json",
                success: function (respuesta, textStatus, jqXHR) {
                    if (respuesta.estado === "success") {
                        mensaje.html(respuesta.mensaje).removeClass("oculto error").addClass("correcto");
                        setTimeout(function () {
                            $("#divMensaje").removeClass("correcto error").addClass("oculto");
                        }, 3000);
                        limpiarFormulario();

                        $("#cerrarModal").trigger("click");

                        // Refrescar la tabla
                        paginar($("#paginacion").attr("data-pagina"));

                    } else {
                        var errores = "<span>Ocurrieron los siguientes fallos:</span>";
                        errores += "<ul class='lista'>";
                        for (var i = 0; i < respuesta.errores.length; i++) {
                            errores += "<li>" + respuesta.errores[i] + "</li>";
                        }
                        errores += "</ul>";
                        mensaje.html(errores).removeClass("oculto").addClass("error");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    mensaje.html("Hubo un error al realizar la petición, por favor inténtelo más tarde.").removeClass("oculto").addClass("error");
                }
            });
        } else {
            $("#divMensajeModal").removeClass("oculto");
            var mensajes = "<span>Ocurrieron los siguientes fallos:</span>";
            for (var a = 0; a < errores.length; a++) {
                mensajes += "<li>" + errores[a] + "</li>";
            }
            mensajes += "</ul>";
            $("#divMensajeModal").html(mensajes);
        }
    }
}

function validarFormulario(actividad) {

    var errores = [];

    var fecha_inicio = new Date(actividad.fecha_inicio);
    var fecha_fin = new Date(actividad.fecha_fin);
    var totalHoras = parseInt(actividad.n_Total_Horas);

    var fechaHorarioInicio = tiempoAFecha(actividad.horario_inicio);
    var fechaHorarioFin = tiempoAFecha(actividad.horario_fin);

    // Validar que la fecha de fin sea mayor o igual a la fecha de inicio
    if (fecha_fin < fecha_inicio) {
        errores.push("La fecha de inicio de actividad debe ser anterior a la fecha de fin.");
    }

    // Validar que la hora fin sea mayor a hora inicio en caso de que fecha inicio sea igual a fecha fin
    if (fecha_fin.getTime() === fecha_inicio.getTime()) {
        if (fechaHorarioFin < fechaHorarioInicio) {
            errores.push("La hora de inicio de actividad debe ser menor a la hora de finalización.");
        } else {
            // Validar que si la actividad empieza y termina el mismo dia el total de horas debe coincidir con
            //   las horas que hay entre hora inicio y hora fin

            var tiempoPasado = Math.round((fechaHorarioFin - fechaHorarioInicio) / 1000 / 60 / 60);
            if (tiempoPasado !== totalHoras) {
                // TODO: pregunta existencial
                errores.push("El total de horas no está comprendido dentro de las horas de la actividad.");
                errores.push("Añada una hora más si el total de horas no es fija.");
            }
        }


    } else {
        // Validar que si la actividad empieza y termina en distinto dia las horas totales (intervalo de
        // hora inicio y hora fin) * dias que dura no debe ser superior a las horas totales
        // Restamos el horario de fin menos el horario inicio en milisegundos.
        var tiempoPasadoEnMs = fecha_fin - fecha_inicio;
        // optenemos los dias pasado entre la fecha de inicio  y la fecha fin (primero pasamos a 
        // milisisegundos luego a segundos, luego a minutos, luego a horas, luego a días y sumanos 1 para 
        // que incluya el primer día).
        var diasPasados = tiempoPasadoEnMs / 1000 / 60 / 60 / 24 + 1;
        // Calculamos la duración de la actividad al día en horas 
        var duracionPorDiaEnMs = fechaHorarioFin - fechaHorarioInicio;
        var duracionPorDia = duracionPorDiaEnMs / 1000 / 60 / 60;
        // Obtenemos las horas supuestas que hay entre la fecha de inicio y la fecha fin.
        var horasSupuestas = Math.round(duracionPorDia * diasPasados);

        if (totalHoras > horasSupuestas) {
            errores.push("El total de horas introducidas es superior al estimado.");
        }
    }


    return errores;
}

function mostrarModal(opciones) {
    // Limpiamos los mensajes del modal
    $("#divMensajeModal").html("");

    $("#nuevaActividad").parent().hide();
    $("#modificarActividad").parent().hide();
    $("#suscribirseActividad").parent().hide();
    $("#contenedorDetallesActividad").hide();
    $("#contenedorFormularioActividad").hide();
    if (opciones.accion === "crear") {
        limpiarFormulario();
        $("#nuevaActividad").parent().show();
        $("#contenedorFormularioActividad").show();
    } else if (opciones.accion === "modificar") {
        $("#modificarActividad").parent().show();
        $("#contenedorFormularioActividad").show();
    } else if (opciones.accion === "ver") {
        if (opciones.participa) {
            $("#suscribirseActividad").parent().hide();
        } else {
            $("#suscribirseActividad").parent().show();
        }
        $("#contenedorDetallesActividad").show();
    }
    $("#modalActividad").openModal();
}

function limpiarFormulario() {
    $("#formularioActividad").trigger("reset");
}

function tiempoAFecha(horarioString) {
    // Usaremos exponente para el nº de veces que hay que multiplicar por 60
    // para pasar de tiempo a segundos
    var exponente, tiempo;

    // Convertimos el string de horario a array
    var horarioArray = horarioString.split(":");

    // Pasamos el array de strings a enteros
    for (var i = 0; i < horarioArray.length; i++) {
        horarioArray[i] = parseInt(horarioArray[i]);
    }

    // Obtenemos el tiempo del array en milisegundos
    var horarioEnMs = 0;

    for (var i = 0; i < horarioArray.length; i++) {

        // Guardamos en tiempo el tiempo con el que iteramos
        tiempo = horarioArray[i];

        // Obtenemos el exponente:
        // hora: 60 * 60 --> 2
        // minutos: 60   --> 1 
        // segundos: 60  --> 0
        exponente = horarioArray.length - (i + 1);

        // Aumentamos el acumulador con el tiempo pasado a milisegundos
        // hora: 60^2 * 1000 = 3.600.000ms
        // minutos: 60^1 * 1000 = 60.000ms
        // segundos: 60^0 * 1000 = 1000ms
        horarioEnMs += tiempo * Math.pow(60, exponente) * 1000;
    }

    // Devolvemos en formato fecha el horario
    // Le restamos una hora porque la 1/1/1970 empieza por defecto a las 01:00:00
    return new Date(horarioEnMs - (60 * 60 * 1000));
}