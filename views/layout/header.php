<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IPS ALMA VIDA - Gestión de Citas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: '#0f172a',
                        surface: '#1e293b',
                        primary: '#06b6d4',
                        primary_hover: '#0891b2',
                        danger: '#ef4444',
                        success: '#10b981',
                        warning: '#f59e0b'
                    }
                }
            }
        }
    </script>
    <style>
        /* Efecto de brillo sutil para los inputs activos */
        .input-form:focus {
            box-shadow: 0 0 10px rgba(6, 182, 212, 0.3);
        }

        /* --- Esto forza los colores cuando se autocompleta --- */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px #0f172a inset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>
<body class="bg-dark text-gray-200 font-sans antialiased min-h-screen selection:bg-primary selection:text-white">
    <nav class="bg-surface/80 backdrop-blur-md border-b border-gray-800 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-dark rounded-xl shadow-[0_0_15px_rgba(6,182,212,0.4)] border border-gray-700">
                        <svg class="w-8 h-8 text-primary drop-shadow-[0_0_8px_rgba(6,182,212,0.8)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.42 4.58a5.4 5.4 0 0 0-7.65 0l-.77.78-.77-.78a5.4 5.4 0 0 0-7.65 0C1.46 6.7 1.33 10.28 4 13l8 8 8-8c2.67-2.72 2.54-6.3.42-8.42z"></path>
                            <path d="M3 12h4.5L9 9l3 6 1.5-3h3.5" stroke="#ffffff" stroke-width="1.5"></path>
                        </svg>
                    </div>
                    <!-- Nombre -->
                    <div class="flex flex-col justify-center ml-2">
                        <span class="text-2xl font-bold tracking-wider text-white flex items-center gap-2">
                            IPS ALMA VIDA
                        </span>
                        <span class="text-primary text-xs font-semibold uppercase tracking-[0.2em]">Gestión Laboral</span>
                    </div>
                </div>
                <!-- Información del usuario -->
                <?php if(isset($_SESSION['usuario_nombre'])): ?>
                <div class="flex items-center gap-4 border-l border-gray-700 pl-6 ml-4">
                    <div class="flex flex-col text-right">
                        <span class="text-xs text-gray-400">Bienvenido,</span>
                        <span class="text-sm font-bold text-white"><?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
                    </div>
                    <!-- Botón de cerrar sesión -->
                    <a href="?controller=login&action=logout" class="bg-dark border border-gray-700 hover:border-danger hover:text-danger text-gray-400 p-2.5 rounded-xl transition-all duration-300 shadow-sm hover:shadow-[0_0_10px_rgba(239,68,68,0.3)]" title="Cerrar Sesión">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">