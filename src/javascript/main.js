const submenuToggles = document.querySelectorAll('.submenu-toggle');

submenuToggles.forEach(toggle => {
    toggle.addEventListener('click', function (e) {
        e.preventDefault();


        const submenu = this.nextElementSibling;


        submenu.classList.toggle('active');
    });
});

function isMobileDevice() {
    const userAgent = navigator.userAgent || navigator.vendor;

    return /android|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(userAgent);
}

window.onload = function () {
    if (/ipad|android(?!.*mobile)/i.test(navigator.userAgent)) {
        return;
    }

    if (isMobileDevice()) {
        if (window.location.pathname !== "/src/pages/Error/mobile.html") {
            window.location.href = "/src/pages/Error/mobile.html";
        } else {
            document.getElementById('content').style.display = 'none';
            document.getElementById('error-message').style.display = 'block';
        }
    }
};

function actualizarTitulo() {
    const tituloBase = "Mi Página";
    const ahora = new Date();
    const opcionesFecha = {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    const opcionesHora = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };

    const fecha = ahora.toLocaleDateString('es-ES', opcionesFecha);
    const hora = ahora.toLocaleTimeString('es-ES', opcionesHora);

    document.title = `${tituloBase} - ${fecha} ${hora}`;
}


setInterval(actualizarTitulo, 1000);

document.addEventListener("DOMContentLoaded", function () {
    function actualizarHeader() {
        const now = new Date();
        const hours = now.getHours();
        let greeting;

        if (hours >= 6 && hours < 12) {
            greeting = "Buenos días";
        } else if (hours >= 12 && hours < 18) {
            greeting = "Buenas tardes";
        } else {

            greeting = "Buenas noches";
        }

        const optionsDate = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const date = now.toLocaleDateString('es-ES', optionsDate);
        const time = now.toLocaleTimeString('es-ES');

        document.getElementById("greeting").textContent = greeting;
        document.getElementById("date").textContent = date;
        document.getElementById("time").textContent = time;
    }


    setInterval(actualizarHeader, 1000);
    actualizarHeader();
});

window.addEventListener('load', function () {
    // Ruta predeterminada para el dashboard
    const rutaDashboard = '/src/pages/core/main.html';

    function cargarContenido(ruta) {
        console.log(`Intentando cargar el contenido de ${ruta}...`);

        fetch(ruta)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error al cargar: ${response.statusText}`);
                }
                return response.text();
            })
            .then(data => {
                console.log("Contenido cargado exitosamente");
                document.getElementById('content').innerHTML = data;
            })
            .catch(error => console.error('Error al cargar el contenido:', error));
    }

    // Cargar el dashboard predeterminado al cargar la página
    cargarContenido(rutaDashboard);

    // Obtener todos los botones en el sidebar con la clase 'sidebar-button'
    const botones = document.querySelectorAll('.sidebar-button');

    // Agregar un evento 'click' a cada botón
    botones.forEach(boton => {
        boton.addEventListener('click', () => {
            const pagina = boton.getAttribute('data-page');
            cargarContenido(`/src/pages/core/${pagina}`);
        });
    });
});

