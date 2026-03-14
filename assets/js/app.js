// Modal de confirmación de eliminación del registro
function confirmarEliminacion(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto! Se eliminará el historial del paciente.",
        icon: 'warning',
        showCancelButton: true,
        background: '#1e293b',
        color: '#e2e8f0',
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#0f172a',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `?controller=paciente&action=eliminar&id=${id}`;
        }
    })
}

// Validaciones visuales de los campos de los formularios crear o editar
document.addEventListener('DOMContentLoaded', function() {
    
    // Buscamos todos los inputs que tengan la clase 'input-form' y sean obligatorios
    const inputsRequeridos = document.querySelectorAll('.input-form[required]');

    inputsRequeridos.forEach(input => {
        
        // BLUR: Ocurre cuando el usuario da clic en un campo y luego se sale sin llenarlo
        input.addEventListener('blur', function() {

            // Se limpian los estilos para que no se acumulen los mensajes cada que entre y salga del campo sin escribir nada
            this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            const mensajeErrorPrevio = this.nextElementSibling;
            if (mensajeErrorPrevio && mensajeErrorPrevio.classList.contains('mensaje-error')) {
                mensajeErrorPrevio.remove();
            }

            // Si el campo está vacío, se dispara la alerta roja
            if (!this.value.trim()) {
                // Se agregan clases de Tailwind para el borde rojo
                this.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                
                // Se crea el texto de error debajo del input
                const mensajeError = document.createElement('p');
                mensajeError.classList.add('text-red-500', 'text-xs', 'mt-1', 'font-medium', 'mensaje-error');
                mensajeError.textContent = 'Este campo es obligatorio.';
                this.parentNode.insertBefore(mensajeError, this.nextSibling);
            }
        });

        // INPUT: Ocurre apenas el usuario empieza a escribir, este borra el error inmediatamente
        input.addEventListener('input', function() {
            this.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
            const mensajeErrorPrevio = this.nextElementSibling;
            if (mensajeErrorPrevio && mensajeErrorPrevio.classList.contains('mensaje-error')) {
                mensajeErrorPrevio.remove();
            }
        });
    });
});