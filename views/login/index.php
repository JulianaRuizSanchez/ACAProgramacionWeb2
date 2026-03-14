<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPS ALMA VIDA - Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { colors: { dark: '#0f172a', surface: '#1e293b', primary: '#06b6d4', primary_hover: '#0891b2' } } }
        }
    </script>
    <style>
        .input-form:focus { box-shadow: 0 0 10px rgba(6, 182, 212, 0.3); }
        input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus, input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #0f172a inset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body class="bg-dark text-gray-200 font-sans antialiased min-h-screen flex items-center justify-center selection:bg-primary selection:text-white relative overflow-hidden">

    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-blue-900/20 rounded-full blur-[100px] pointer-events-none"></div>
    <!-- Formulario de inicio de sesión -->
    <div class="w-full max-w-md p-8 relative z-10">
        <div class="bg-surface/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-700/50 p-10">
            <!-- Logo -->
            <div class="flex flex-col items-center justify-center mb-8">
                <div class="p-3 bg-dark rounded-2xl shadow-[0_0_20px_rgba(6,182,212,0.5)] border border-gray-700 mb-4">
                    <svg class="w-12 h-12 text-primary drop-shadow-[0_0_10px_rgba(6,182,212,0.8)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"></path>
                        <path d="M3 12h4.5L9 9l3 6 1.5-3h3.5" stroke="#ffffff" stroke-width="1.5"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold tracking-wider text-white">ALMA VIDA</h1>
                <p class="text-primary text-xs font-semibold uppercase tracking-[0.2em] mt-1">Gestión Laboral</p>
            </div>

            <h2 class="text-center text-gray-400 text-sm mb-8">Ingresa tus credenciales para acceder</h2>
            <!-- Formulario -->
            <form action="?controller=login&action=login" method="POST" class="space-y-6" novalidate>
                <div>
                    <label class="block text-xs font-medium text-gray-400 mb-2 uppercase tracking-wide">Usuario / Correo</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <input type="email" name="correo" placeholder="admin@almavida.com" required class="input-form w-full bg-dark border border-gray-700 rounded-xl pl-12 pr-4 py-3 text-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-medium text-gray-400 uppercase tracking-wide">Contraseña</label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        </div>
                        <input type="password" name="password" placeholder="••••••••" required class="input-form w-full bg-dark border border-gray-700 rounded-xl pl-12 pr-4 py-3 text-gray-200 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors">
                    </div>
                </div>
                <!-- Botón de envío -->
                <div class="pt-2">
                    <button type="submit" class="w-full bg-primary hover:bg-primary_hover text-white font-bold tracking-wide py-3.5 px-4 rounded-xl shadow-[0_0_15px_rgba(6,182,212,0.4)] transition-all duration-300 transform hover:-translate-y-1">
                        Iniciar Sesión
                    </button>
                </div>
            </form>
            <!-- Credenciales de demostración -->
            <div class="mt-8 bg-dark/50 border border-primary/20 rounded-xl p-4 text-center shadow-inner">
                <div class="flex justify-center items-center gap-2 mb-2">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-xs text-primary uppercase tracking-wider font-semibold">Credenciales Demo</span>
                </div>
                <div class="text-sm text-gray-400 font-mono flex flex-col gap-1">
                    <p>Correo: <span class="text-white font-bold select-all">admin@almavida.com</span></p>
                    <p>Clave: <span class="text-white font-bold select-all">admin123</span></p>
                </div>
            </div>

        </div>
        
        <p class="text-center text-gray-600 text-xs mt-8">&copy; 2026 IPS Alma Vida. Todos los derechos reservados.</p>
    </div>
    
    <!-- Mensaje de error -->
    <?php if(isset($_GET['error']) && $_GET['error'] == 1): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Acceso Denegado',
            text: 'El correo o la contraseña son incorrectos.',
            background: '#1e293b',
            color: '#e2e8f0',
            confirmButtonColor: '#06b6d4'
        });
    </script>
    <?php endif; ?>
    <!-- Llama a los scripts de la aplicación -->
    <script src="assets/js/app.js?v=<?php echo time(); ?>"></script>

</body>
</html>