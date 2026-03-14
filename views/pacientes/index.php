<!-- Parte del cuerpo de la página, el header y footer es el mismo por lo que se llama la vista nuevamente -->
<!-- Listado de pacientes -->
<?php require_once 'views/layout/header.php'; ?>

<div class="flex justify-between items-center mb-8">
    <h2 class="text-3xl font-light text-white tracking-wide">Listado de <span class="font-bold text-primary">Pacientes</span></h2>
    <a href="?controller=paciente&action=crear" class="bg-primary hover:bg-primary_hover text-white font-semibold px-5 py-2.5 rounded-lg shadow-[0_0_15px_rgba(6,182,212,0.4)] transition-all duration-300 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
        Registrar Paciente
    </a>
</div>

<div class="bg-surface p-5 rounded-xl shadow-lg border border-gray-700/50 mb-8 flex flex-col md:flex-row gap-4 items-center">
    <!-- Selector de límite de resultados por página -->
    <div class="w-full md:w-32 flex items-center gap-2 text-gray-400 text-sm">
        <span>Mostrar</span>
        <select id="selector_limite" class="bg-dark border border-gray-700 rounded-lg px-2 py-2 text-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary appearance-none text-center">
            <option value="5">5</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    <!-- Buscador -->
    <div class="flex-1 w-full relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
        </div>
        <input type="text" id="buscador" placeholder="Buscar documento, nombre o empresa..." class="w-full bg-dark border border-gray-700 rounded-lg pl-10 pr-4 py-2.5 text-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
    </div>
    <!-- Filtro por examen -->
    <div class="w-full md:w-48">
        <select id="filtro_examen" class="w-full bg-dark border border-gray-700 rounded-lg px-4 py-2.5 text-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary appearance-none transition-colors">
            <option value="">Todos los exámenes</option>
            <option value="Ingreso">Ingreso</option>
            <option value="Egreso">Egreso</option>
            <option value="Periodico">Periódico</option>
        </select>
    </div>
    <!-- Filtro por doctor -->
    <div class="w-full md:w-48">
        <select id="filtro_doctor" class="w-full bg-dark border border-gray-700 rounded-lg px-4 py-2.5 text-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary appearance-none transition-colors">
            <option value="">Todos los doctores</option>
            <option value="Pedro">Dr. Pedro</option>
            <option value="Samanta">Dra. Samanta</option>
        </select>
    </div>
</div>
<!-- Tabla de pacientes -->
<div class="bg-surface rounded-xl shadow-2xl overflow-hidden border border-gray-700/50">
    <table class="w-full text-left border-collapse" id="tablaPacientes">
        <thead class="bg-dark/80 text-gray-400 text-xs uppercase tracking-widest border-b border-gray-700">
            <tr>
                <th class="px-6 py-5 font-semibold text-center">Documento</th>
                <th class="px-6 py-5 font-semibold text-center">Paciente</th>
                <th class="px-6 py-5 font-semibold text-center">Cita (Examen/Doc)</th>
                <th class="px-6 py-5 font-semibold text-center">Fecha/Hora</th>
                <th class="px-6 py-5 font-semibold text-center">Estado</th>
                <th class="px-6 py-5 font-semibold text-center">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800/60 text-sm">
            <?php if (isset($pacientes) && count($pacientes) > 0): ?>
                <?php foreach ($pacientes as $row): ?>
                    <tr class="hover:bg-gray-800/40 transition-colors duration-200 fila-paciente group text-center">
                        <td class="px-6 py-5 text-gray-300 doc-busqueda font-mono"><?php echo htmlspecialchars($row['numero_documento']); ?></td>
                        <td class="px-6 py-5 font-medium text-white nombre-busqueda">
                            <?php echo htmlspecialchars($row['nombre_completo']); ?><br>
                            <span class="text-xs text-gray-500 font-normal empresa-busqueda"><?php echo htmlspecialchars($row['empresa_solicita']); ?></span>
                        </td>
                        <td class="px-6 py-5 text-gray-400">
                            <span class="bg-dark text-primary px-2.5 py-1 rounded border border-primary/30 text-xs font-medium tipo-examen-busqueda shadow-[0_0_8px_rgba(6,182,212,0.15)]">
                                <?php echo htmlspecialchars($row['tipo_examen']); ?>
                            </span><br>
                            <span class="text-xs mt-2 inline-block text-gray-400 doctor-busqueda"><?php echo htmlspecialchars($row['doctor'] ?? 'Sin asignar'); ?></span>
                        </td>
                        <td class="px-6 py-5 text-gray-300">
                            <?php echo htmlspecialchars($row['fecha_examen']); ?><br>
                            <span class="text-xs font-semibold text-primary inline-block mt-1 tracking-wide">
                                <?php echo htmlspecialchars($row['hora_examen'] ? date('h:i A', strtotime($row['hora_examen'])) : '--:--'); ?>
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <?php 
                                $estado = $row['estado'] ?? 'Pendiente';
                                $colorEstado = $estado == 'Pendiente' ? 'bg-warning/10 text-warning border-warning/50' : 
                                              ($estado == 'Hecho' ? 'bg-success/10 text-success border-success/50' : 
                                              'bg-danger/10 text-danger border-danger/50');
                            ?>
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold tracking-wider border <?php echo $colorEstado; ?>">
                                <?php echo strtoupper($estado); ?>
                            </span>
                        </td>
                        <!-- Botones para las acciones (Hecho, Anular, Editar y Eliminar) -->
                        <td class="px-6 py-5 text-center">
                            <!-- Si el estado es Pendiente se muestran -->
                            <?php if($estado == 'Pendiente'): ?>
                                <div class="flex justify-center gap-3 mb-2">
                                    <a href="?controller=paciente&action=cambiar_estado&id=<?php echo $row['id']; ?>&estado=Hecho" class="text-success hover:text-green-300 hover:scale-110 transition-transform" title="Marcar como Hecho">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </a>
                                    <a href="?controller=paciente&action=cambiar_estado&id=<?php echo $row['id']; ?>&estado=Anulado" class="text-danger hover:text-red-300 hover:scale-110 transition-transform" title="Anular Cita">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </a>
                                </div>
                                <div class="flex justify-center gap-3 text-xs font-medium border-t border-gray-700/50 pt-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <a href="?controller=paciente&action=editar&id=<?php echo $row['id']; ?>" class="text-primary hover:text-primary_hover transition-colors">Editar</a>
                                    <button onclick="confirmarEliminacion(<?php echo $row['id']; ?>)" class="text-gray-500 hover:text-danger transition-colors">Eliminar</button>
                                </div>
                                <!-- Si el estado no es Pendiente se ocultan y solo muestra Registro Cerrado -->
                            <?php else: ?>
                                <span class="text-gray-600 text-xs italic font-medium">Registro Cerrado</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <!-- Si no hay pacientes registrados -->
            <?php else: ?>
                <tr id="fila-vacia-bd"><td colspan="6" class="px-6 py-12 text-center text-gray-500 text-lg">No hay pacientes registrados aún. Comienza agendando uno nuevo.</td></tr>
                <!-- Si se busca y no coincide ningún resultado -->
            <?php endif; ?>
                <tr id="fila-sin-resultados" style="display: none;"><td colspan="6" class="px-6 py-12 text-center text-gray-500 text-lg">No se encontraron resultados para tu búsqueda.</td></tr>
        </tbody>
    </table>
    <!-- Controles de paginación y carga de datos a la lista -->
    <?php if (isset($pacientes) && count($pacientes) > 0): ?>
    <div class="bg-dark/50 border-t border-gray-700 px-6 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="text-sm text-gray-400" id="info_paginacion">
            Cargando información...
        </div>
        <div class="flex gap-2" id="controles_paginacion">
            </div>
    </div>
    <?php endif; ?>
</div>

<script>
    // Script para manejar la búsqueda, los filtros y la paginación de manera combinada y eficiente en el frontend sin recargar la página
document.addEventListener('DOMContentLoaded', function() {
    const buscador = document.getElementById('buscador');
    const filtroExamen = document.getElementById('filtro_examen');
    const filtroDoctor = document.getElementById('filtro_doctor');
    const selectorLimite = document.getElementById('selector_limite');
    
    const infoPaginacion = document.getElementById('info_paginacion');
    const controlesPaginacion = document.getElementById('controles_paginacion');
    const filaSinResultados = document.getElementById('fila-sin-resultados');
    
    // Se obtienen todas las filas reales (se ignoran las "sin resultados")
    const filas = Array.from(document.querySelectorAll('.fila-paciente'));

    let paginaActual = 1;
    let registrosPorPagina = parseInt(selectorLimite?.value || 15);
    let filasFiltradas = [];

    // Función principal que filtra y luego pagina
    function aplicarFiltrosYPaginacion() {
        const textoBusqueda = buscador.value.toLowerCase();
        const valorExamen = filtroExamen.value.toLowerCase();
        const valorDoctor = filtroDoctor.value.toLowerCase();

        // Filtrar filas según búsqueda y/o filtros
        filasFiltradas = filas.filter(fila => {
            const textoFila = fila.textContent.toLowerCase();
            const examenFila = fila.querySelector('.tipo-examen-busqueda').textContent.toLowerCase();
            const doctorFila = fila.querySelector('.doctor-busqueda').textContent.toLowerCase();

            const coincideBusqueda = textoFila.includes(textoBusqueda);
            const coincideExamen = valorExamen === "" || examenFila.includes(valorExamen);
            const coincideDoctor = valorDoctor === "" || doctorFila.includes(valorDoctor);

            // Se ocultan todas primero
            fila.style.display = 'none';

            return coincideBusqueda && coincideExamen && coincideDoctor;
        });

        // Mostrar mensaje si no hay resultados
        if (filaSinResultados) {
            filaSinResultados.style.display = filasFiltradas.length === 0 ? '' : 'none';
        }

        // Paginar
        const totalPaginas = Math.ceil(filasFiltradas.length / registrosPorPagina) || 1;
        // Si al filtrar no se queda en una página que ya no existe, regresa a la 1
        if (paginaActual > totalPaginas) paginaActual = 1;

        const inicio = (paginaActual - 1) * registrosPorPagina;
        const fin = inicio + registrosPorPagina;

        // Extraer solo el pedazo (slice) de filas que tocan en esta página
        const filasAMostrar = filasFiltradas.slice(inicio, fin);
        
        // Mostrar solo esas filas
        filasAMostrar.forEach(fila => fila.style.display = '');

        // Actualizar UI de paginación
        if (infoPaginacion && controlesPaginacion) {
            renderizarControles(totalPaginas, filasFiltradas.length, inicio, fin);
        }
    }

    // Dibuja los botones numéricos
    function renderizarControles(totalPaginas, totalRegistros, inicio, fin) {
        const finReal = Math.min(fin, totalRegistros);
        const inicioReal = totalRegistros === 0 ? 0 : inicio + 1;
        infoPaginacion.innerHTML = `Mostrando <span class="font-medium text-white">${inicioReal}</span> a <span class="font-medium text-white">${finReal}</span> de <span class="font-medium text-white">${totalRegistros}</span> resultados`;

        controlesPaginacion.innerHTML = '';

        // Botón Anterior
        const btnAnt = document.createElement('button');
        btnAnt.innerHTML = '&laquo;';
        btnAnt.className = `px-3 py-1 rounded border text-sm font-medium transition-colors ${paginaActual === 1 ? 'bg-gray-800 border-gray-700 text-gray-500 cursor-not-allowed' : 'bg-surface border-gray-600 text-gray-300 hover:bg-gray-700 hover:text-white'}`;
        btnAnt.disabled = paginaActual === 1;
        btnAnt.onclick = () => { paginaActual--; aplicarFiltrosYPaginacion(); };
        controlesPaginacion.appendChild(btnAnt);

        // Botones de Números
        for (let i = 1; i <= totalPaginas; i++) {
            const btnNum = document.createElement('button');
            btnNum.textContent = i;
            if (i === paginaActual) {
                btnNum.className = 'px-3 py-1 rounded border border-primary bg-primary text-white text-sm font-medium shadow-[0_0_10px_rgba(6,182,212,0.4)]';
            } else {
                btnNum.className = 'px-3 py-1 rounded border border-gray-600 bg-surface text-gray-300 text-sm font-medium hover:bg-gray-700 hover:text-white transition-colors';
            }
            btnNum.onclick = () => { paginaActual = i; aplicarFiltrosYPaginacion(); };
            controlesPaginacion.appendChild(btnNum);
        }

        // Botón Siguiente
        const btnSig = document.createElement('button');
        btnSig.innerHTML = '&raquo;';
        btnSig.className = `px-3 py-1 rounded border text-sm font-medium transition-colors ${paginaActual === totalPaginas ? 'bg-gray-800 border-gray-700 text-gray-500 cursor-not-allowed' : 'bg-surface border-gray-600 text-gray-300 hover:bg-gray-700 hover:text-white'}`;
        btnSig.disabled = paginaActual === totalPaginas;
        btnSig.onclick = () => { paginaActual++; aplicarFiltrosYPaginacion(); };
        controlesPaginacion.appendChild(btnSig);
    }

    // Escucha eventos de cambio en filtros y búsqueda
    buscador.addEventListener('input', () => { paginaActual = 1; aplicarFiltrosYPaginacion(); });
    filtroExamen.addEventListener('change', () => { paginaActual = 1; aplicarFiltrosYPaginacion(); });
    filtroDoctor.addEventListener('change', () => { paginaActual = 1; aplicarFiltrosYPaginacion(); });

    // Escucha cambio en selector de límite de registros por página
    if (selectorLimite) {
        selectorLimite.addEventListener('change', (e) => { 
            registrosPorPagina = parseInt(e.target.value); 
            paginaActual = 1; // Volver a la página 1 al cambiar el límite
            aplicarFiltrosYPaginacion(); 
        });
    }

    // Ejecuta al cargar la página por primera vez
    aplicarFiltrosYPaginacion();
});
</script>

<?php require_once 'views/layout/footer.php'; ?>