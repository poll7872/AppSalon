let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

const cita = {
    id: '',
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
}

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp() {
    tabs(); // Cambia la sección cuando se presionen los tabs
    mostrarSeccion(); // Muestra y oculta las secciones
    botonesPaginador(); // Agrega o remueve los botones del paginador
    paginaSiguiente();
    paginaAnterior();
    
    consultarAPI();//consulta la api de PHP

    idCliente();
    nombreCliente(); //Añade el nombre del cliente al objeto cita
    seleccionarFecha(); //Añade la fecha en el objeto cita
    seleccionarHora(); //Añade la hora en el objeto cita
    mostrarResumen(); //Muestra el resumen de la cita
}

function mostrarSeccion() {
    // Oculta todas las secciones
    const secciones = document.querySelectorAll('.seccion');
    secciones.forEach(seccion => {
        seccion.classList.remove('visible');
        seccion.classList.add('hidden');
    });

    // Muestra la sección actual
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.remove('hidden');
    seccion.classList.add('visible');
}

function tabs() {
    const botones = document.querySelectorAll('.tabs button');

    botones.forEach(boton => {
        boton.addEventListener('click', function(e) {
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            botonesPaginador();
        });
    });
}

function botonesPaginador() {
    const botones = document.querySelectorAll('.tabs button');
    botones.forEach(b => {
        b.classList.remove('bg-white', 'text-blue-600');
    });

    const botonActual = document.querySelector(`.tabs button[data-paso="${paso}"]`);
    botonActual.classList.add('bg-white', 'text-blue-600');

    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');
    const containerPag = document.querySelector('#containerPag');

    if (paso === pasoInicial) {
        paginaAnterior.classList.add('hidden');
        paginaSiguiente.classList.remove('hidden');
        containerPag.classList.remove('justify-start', 'justify-between');
        containerPag.classList.add('justify-end');
    } else if (paso === pasoFinal) {
        paginaAnterior.classList.remove('hidden');
        paginaSiguiente.classList.add('hidden');
        containerPag.classList.remove('justify-end', 'justify-between');
        containerPag.classList.add('justify-start');
        mostrarResumen();
    } else {
        paginaAnterior.classList.remove('hidden');
        paginaSiguiente.classList.remove('hidden');
        containerPag.classList.remove('justify-end', 'justify-start');
        containerPag.classList.add('justify-between');
    }
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function() {
        if (paso > pasoInicial) {
            paso--;
            botonesPaginador();
            mostrarSeccion();
        }
    });
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function() {
        if (paso < pasoFinal) {
            paso++;
            botonesPaginador();
            mostrarSeccion();
        }
    });
}

async function consultarAPI(){
    try {
        const URL = 'http://localhost:3000/api/servicios';
        const resultado = await fetch(URL);
        const servicios = await resultado.json();
        
        mostrarServicios(servicios);
    } catch (error) {
        console.log(error);
    }
}

function mostrarServicios(servicios) {
    servicios.forEach( servicio => {
        const { id, nombre, precio } = servicio;

        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('text-gray-900');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('text-blue-600', 'font-bold');
        precioServicio.textContent = `$${precio}`;

        const servicioDiv = document.createElement('DIV')
        servicioDiv.classList.add('bg-white', 'p-3', 'rounded-lg', 'text-center', 'cursor-pointer', 'hover:scale-105');
        servicioDiv.dataset.idServicio = id;
        servicioDiv.onclick = function() {
            seleccionarServicio(servicio);
        }

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        document.querySelector('#servicios').appendChild(servicioDiv);  
    })
}

function seleccionarServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;
    const servicioIndex = servicios.findIndex(s => s.id === id);

    // Verificar si el servicio ya está seleccionado
    if (servicioIndex !== -1) {
        // Si está seleccionado, quitarlo de la lista de servicios
        cita.servicios.splice(servicioIndex, 1);
        
        // Obtener el elemento del servicio y cambiar su estado a no seleccionado
        const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
        divServicio.classList.remove('bg-blue-600');
        divServicio.classList.add('bg-white');
        
        // Obtener los elementos de texto dentro del servicio y cambiar su color a su estado original
        const nombreElement = divServicio.querySelector('.text-gray-900');
        const precioElement = divServicio.querySelector('.text-blue-600');
        
        nombreElement.classList.remove('text-white');
        precioElement.classList.remove('text-white');
    } else {
        // Si no está seleccionado, agregarlo a la lista de servicios y cambiar su estado a seleccionado
        cita.servicios = [...servicios, servicio];

        const divServicio = document.querySelector(`[data-id-servicio="${id}"]`);
        divServicio.classList.remove('bg-white');
        divServicio.classList.add('bg-blue-600');

        // Obtener los elementos de texto dentro del servicio y cambiar su color a blanco
        const nombreElement = divServicio.querySelector('.text-gray-900');
        const precioElement = divServicio.querySelector('.text-blue-600');

        nombreElement.classList.add('text-white');
        precioElement.classList.add('text-white');
    }
    console.log(cita)
}

function idCliente() {
    cita.id = document.querySelector('#id').value;
}

function nombreCliente() {
    cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
    const inputFecha = document.querySelector("#fecha");
    inputFecha.addEventListener('input', function(e) {
        
        const dia = new Date(e.target.value).getUTCDay();

        if ( [6, 0].includes(dia) ) {
            e.target.value = '';
            mostrarAlerta('Fines de semana cerrado', '#paso-2');
        } else {
            cita.fecha = e.target.value;
        }

    })
}

function seleccionarHora() {
    const inputHora = document.querySelector('#hora');
    inputHora.addEventListener('input', function(e) {
        const horaCita = e.target.value;
        const hora = horaCita.split(":")[0];
        
        if (hora < 9 || hora > 19) {
            e.target.value = ''
            mostrarAlerta('Esta cerrado - Disponible desde las 9 hasta las 19', '#paso-2')
        } else {
            cita.hora = e.target.value
            console.log(cita)
        }
    })
}

function mostrarAlerta(mensaje, elemento, desaparece = true) {
    //Previene que se genera mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if (alertaPrevia) {
        alertaPrevia.remove();
    }

    //Scripting para generar la alerta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('bg-red-600', 'text-center', 'p-2', 'rounded-lg', 'mb-2', 'alerta');

    const referencia = document.querySelector(elemento)
    referencia.appendChild(alerta);

    //Elimina la alerta despues de 4 segundos
    if (desaparece) {
        setTimeout(() => {
            alerta.remove();
        }, 4000);
    }
}

function mostrarResumen() {
    const resumen = document.querySelector('.contenido-resumen');

    //Limpiar el contenido de resumen
    while (resumen.firstChild) {
        resumen.removeChild(resumen.firstChild)
    }

    if (Object.values(cita).includes('') || cita.servicios.length === 0) {
        mostrarAlerta('Faltan datos de Servicios, Fecha u Hora', '#paso-3', false)
        return;
    }

    // Formatear el div de resumen
    const { nombre, fecha, hora, servicios } = cita;

    //Heading servicios y resumen
    const headingServicio = document.createElement('H2');
    headingServicio.classList.add('font-bold', 'text-white', 'text-center', 'text-2xl', 'mb-4');
    headingServicio.textContent = 'Resumen de Servicios'
    resumen.appendChild(headingServicio); 

    //Iterar para mostrar los servicios
    servicios.forEach(servicio => {
        const { id, precio, nombre } = servicio;

        const contenedorServicio = document.createElement('DIV');
        contenedorServicio.classList.add('border-b', 'my-4', 'py-4');

        const textoServicio = document.createElement('P')
        textoServicio.textContent = nombre;

        const precioServicio = document.createElement('P')
        precioServicio.innerHTML = `<span class="text-blue-400 font-bold">Precio:</span> $${precio}`

        contenedorServicio.appendChild(textoServicio);
        contenedorServicio.appendChild(precioServicio);

        resumen.appendChild(contenedorServicio);
    })

    //Heading de información cita resumen
    const headingCita = document.createElement('H2');
    headingCita.classList.add('font-bold', 'text-white', 'text-center', 'text-2xl', 'mb-4');
    headingCita.textContent = 'Resumen de Cita'
    resumen.appendChild(headingCita);

    const nombreCliente = document.createElement('P');
    nombreCliente.innerHTML = `<span class="text-blue-400 font-bold mb-2">Nombre:</span> ${nombre}`;  
    
    //Formatear fecha en UTC
    const fechaObj = new Date(fecha);
    const mes = fechaObj.getMonth();
    const dia = fechaObj.getDate() + 2;
    const year = fechaObj.getFullYear();

    const fechaUTC = new Date(Date.UTC(year, mes, dia));
    const opciones = {weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'};
    const fechaFormateada = fechaUTC.toLocaleDateString('es-CO', opciones);
    console.log(fechaFormateada)
    
    const fechaCita = document.createElement('P');
    fechaCita.innerHTML = `<span class="text-blue-400 font-bold mb-2">Fecha:</span> ${fechaFormateada}`;

    const horaCita = document.createElement('P');
    horaCita.innerHTML = `<span class="text-blue-400 font-bold mb-2">Hora:</span> ${hora}`;

    //Botón para enviar datos de la cita
    const botonReservar = document.createElement('BUTTON');
    botonReservar.classList.add('p-2', 'md:w-32', 'bg-blue-600', 'rounded-lg', 'my-3');
    botonReservar.textContent = 'Reservar Cita';
    botonReservar.onclick = reservarCita;

    resumen.appendChild(nombreCliente);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);
    
    resumen.appendChild(botonReservar); 
}

async function reservarCita() {
    
    const { id, fecha, hora, servicios } = cita;

    const idServicio = servicios.map( servicio => servicio.id)

    const datos = new FormData();
    datos.append('fecha', fecha);
    datos.append('hora', hora);
    datos.append('usuario_id', id);
    datos.append('servicios', idServicio);

    //console.log([...datos])

    try {

        //Petición hacia la API
        const URL = 'http://localhost:3000/api/citas'

        const respuesta = await fetch(URL, {
            method: 'POST',
            body: datos
        });

        const resultado = await respuesta.json();
        console.log(resultado)

        if (resultado.resultado) {
            Swal.fire({
                icon: "success",
                title: "Cita Creada",
                text: "Tu cita fue creada correctamente",
                button: "OK"
            }).then ( () => {
                setTimeout(() => {
                    window.location.reload(); 
                }, 2000);
            })
        }

    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un error en guardar la cita"
        });
    }
    
    
}