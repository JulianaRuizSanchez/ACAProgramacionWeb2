<!-- Parte del cuerpo de la página, el header y footer es el mismo por lo que se llama la vista nuevamente -->
<!-- Formulario para crear un nuevo paciente -->
<?php require_once 'views/layout/header.php'; ?>

<div class="max-w-5xl mx-auto bg-surface mt-8 p-8 rounded-xl shadow-2xl border border-gray-800">
    <div class="flex justify-between items-center mb-8 border-b border-gray-800 pb-4">
        <h2 class="text-2xl font-semibold text-white">Agendar Nueva Cita</h2>
        <a href="?controller=paciente&action=index" class="bg-gray-800 hover:bg-gray-700 text-gray-300 px-4 py-2 rounded-lg text-sm border border-gray-700">&larr; Volver</a>
    </div>

    <form action="?controller=paciente&action=guardar" method="POST" id="formCrear" novalidate>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            
            <div class="md:col-span-2 mb-2"><h3 class="text-primary text-sm font-bold uppercase tracking-wider">Datos Personales</h3></div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Nombre Completo *</label>
                <input type="text" name="nombre_completo" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Tipo de Documento *</label>
                <select id="tipo_doc" name="tipo_documento" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
                    <option value="">Seleccione...</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Número de Documento *</label>
                <input type="text" id="num_doc" name="numero_documento" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Dirección</label>
                <input type="text" name="direccion" class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Teléfono Fijo</label>
                <input type="text" name="telefono" class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Celular *</label>
                <input type="text" name="celular" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Fecha de Nacimiento *</label>
                <input type="date" name="fecha_nacimiento" required style="color-scheme: dark;" class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Edad *</label>
                <input type="number" name="edad" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">EPS *</label>
                <input type="text" name="eps" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>

            <div class="md:col-span-2 mt-4"><h3 class="text-primary text-sm font-bold uppercase tracking-wider">Contacto de Emergencia</h3></div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Contacto Adicional (Nombre y Teléfono)</label>
                <input type="text" name="contacto_adicional" class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Parentesco</label>
                <input type="text" name="parentesco" class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>

            <div class="md:col-span-2 mt-4"><h3 class="text-primary text-sm font-bold uppercase tracking-wider">Agendamiento</h3></div>

            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Tipo de Examen *</label>
                <select id="tipo_examen" name="tipo_examen" required class="input-form check-agenda w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
                    <option value="">Seleccione...</option>
                    <option value="Ingreso">Examen de Ingreso</option>
                    <option value="Egreso">Examen de Egreso</option>
                    <option value="Periodico">Examen Periódico</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Empresa que Solicita *</label>
                <input type="text" name="empresa_solicita" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Doctor *</label>
                <select id="doctor" name="doctor" required class="input-form check-agenda w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
                    <option value="">Seleccione...</option>
                    <option value="Pedro">Dr. Pedro</option>
                    <option value="Samanta">Dra. Samanta</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Fecha del Examen *</label>
                <input type="date" id="fecha_examen" name="fecha_examen" min="<?php echo date('Y-m-d'); ?>" required style="color-scheme: dark;" class="input-form check-agenda w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-400 mb-2">Hora de la Cita *</label>
                <select id="hora_examen" name="hora_examen" required class="input-form w-full bg-dark border border-gray-700 rounded-lg px-4 py-2 text-gray-200 outline-none" disabled>
                    <option value="">Complete tipo documento, documento, examen, fecha y doctor primero...</option>
                </select>
            </div>
        </div>
        <div class="mt-10 pt-6 border-t border-gray-800 flex justify-end">
            <button type="submit" id="btnGuardar" disabled class="bg-primary text-white font-medium py-3 px-8 rounded-lg shadow-lg flex items-center gap-2 opacity-50 cursor-not-allowed transition-all">
                Guardar Cita
            </button>
        </div>
    </form>
</div>

<script>
    // Lógica para validar que el formulario esté completo y habilitar el botón Guardar cuando los campoos requeridos estén llenos,
    // además de consultar la disponibilidad de horas en base a los datos ingresados y mostrar solo las horas disponibles para agendar la cita.
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formCrear');
    const inputsRequeridos = form.querySelectorAll('.input-form[required]');
    const btnGuardar = document.getElementById('btnGuardar');
    
    const tipoDoc = document.getElementById('tipo_doc');
    const numDoc = document.getElementById('num_doc');
    const tipoExamen = document.getElementById('tipo_examen');
    const doctor = document.getElementById('doctor');
    const fechaExamen = document.getElementById('fecha_examen');
    const horaExamen = document.getElementById('hora_examen');

    // Función para validar que todos los campos requeridos estén llenos y habilitar/deshabilitar el botón Guardar
    function validarFormularioCompleto() {
        let todoLleno = true;
        inputsRequeridos.forEach(input => { if (!input.value.trim()) todoLleno = false; });
        if (todoLleno) {
            btnGuardar.disabled = false;
            btnGuardar.classList.remove('opacity-50', 'cursor-not-allowed');
            btnGuardar.classList.add('hover:bg-teal-700');
        } else {
            btnGuardar.disabled = true;
            btnGuardar.classList.add('opacity-50', 'cursor-not-allowed');
            btnGuardar.classList.remove('hover:bg-teal-700');
        }
    }

    // Agregar eventos a los campos requeridos para validar el formulario en tiempo real
    inputsRequeridos.forEach(input => {
        input.addEventListener('input', validarFormularioCompleto);
        input.addEventListener('change', validarFormularioCompleto);
    });

    // Función para consultar la disponibilidad de horas según los datos ingresados y actualizar el select de horas disponibles
    async function consultarDisponibilidad() {
        if(tipoDoc.value && numDoc.value && tipoExamen.value && doctor.value && fechaExamen.value) {
            horaExamen.innerHTML = '<option value="">Cargando horarios...</option>';
            horaExamen.disabled = true;

            try {
                // Realizar la consulta al backend para obtener las horas ocupadas y si el paciente tiene una cita pendiente para ese examen
                const url = `?controller=paciente&action=consultar_agenda&tipo_doc=${tipoDoc.value}&num_doc=${numDoc.value}&tipo_examen=${tipoExamen.value}&fecha=${fechaExamen.value}&doctor=${doctor.value}`;
                const response = await fetch(url);
                const data = await response.json();

                if (data.tiene_pendiente) {
                    Swal.fire({
                        icon: 'error', 
                        title: 'Paciente Bloqueado',
                        text: 'Este paciente ya tiene una cita PENDIENTE para este mismo examen.',
                        background: '#1e293b', 
                        color: '#e0e0e0', 
                        confirmButtonColor: '#06b6d4'
                    });
                    tipoExamen.value = '';
                    horaExamen.innerHTML = '<option value="">Complete los datos primero...</option>';
                    validarFormularioCompleto();
                    return;
                }

                horaExamen.innerHTML = '<option value="">Seleccione una hora...</option>';
                const horasLaborales = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'];
                let horasDisponibles = 0;

                const ahora = new Date();
                const fechaHoy = ahora.getFullYear() + '-' + String(ahora.getMonth() + 1).padStart(2, '0') + '-' + String(ahora.getDate()).padStart(2, '0');
                const horaActual = ahora.getHours(); 
                
                // Recorrer las horas laborales y agregar al select solo las que no estén ocupadas y que no hayan pasado si la fecha es hoy
                horasLaborales.forEach(hora => {
                    const horaInt = parseInt(hora.split(':')[0]);
                    let yaPaso = false;
                    if (fechaExamen.value === fechaHoy && horaInt <= horaActual) yaPaso = true;

                    if (!data.horas_ocupadas.includes(hora) && !yaPaso) {
                        const option = document.createElement('option');
                        option.value = hora;
                        const ampm = horaInt >= 12 ? 'PM' : 'AM';
                        const horaFormat = horaInt > 12 ? horaInt - 12 : horaInt;
                        option.textContent = `${horaFormat}:00 ${ampm}`;
                        horaExamen.appendChild(option);
                        horasDisponibles++;
                    }
                });

                // Si no hay horas disponibles, mostrar mensaje y mantener el select de horas deshabilitado
                if (horasDisponibles === 0) {
                    horaExamen.innerHTML = '<option value="">Agenda llena / Horas pasadas</option>';
                    Swal.fire({ icon: 'warning', 
                    title: 'Sin disponibilidad', 
                    text: `El Dr/a. ${doctor.value} no tiene cupos o los horarios ya pasaron.`, 
                    background: '#1e293b', 
                    color: '#e0e0e0', 
                    confirmButtonColor: '#06b6d4' });
                } else {
                    horaExamen.disabled = false;
                }
                
                validarFormularioCompleto();

            } catch (error) {
                console.error("Error:", error);
            }
        }
    }

    // Agregar eventos a los campos relevantes para consultar la disponibilidad de horas cada vez que cambien
    document.querySelectorAll('.check-agenda').forEach(input => {
        input.addEventListener('change', consultarDisponibilidad);
    });
    numDoc.addEventListener('blur', consultarDisponibilidad);
});
</script>

<?php require_once 'views/layout/footer.php'; ?>