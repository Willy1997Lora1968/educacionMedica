window.onload = function() {
    var form = document.querySelector('form');
    form.addEventListener('submit', function(event) {
        var nombre = document.getElementById('nombre').value;
        var correo = document.getElementById('correo').value;
        var pregunta = document.getElementById('pregunta').value;

        if (nombre === '' || correo === '' || pregunta === '') {
            alert('Por favor, completa todos los campos.');
            event.preventDefault();
        }

        var regexCorreo = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
        if (!regexCorreo.test(correo)) {
            alert('Por favor, introduce un correo electrónico válido.');
            event.preventDefault();
        }
    });
}
