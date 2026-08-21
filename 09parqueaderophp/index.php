<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Vehículos - Ingreso</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
            --bg-gradient-dark: #090d16;
            --bg-gradient-light: #f1f5f9;
        }

        [data-bs-theme="dark"] body {
            background-color: var(--bg-gradient-dark);
            color: #f8fafc;
        }

        [data-bs-theme="light"] body {
            background-color: var(--bg-gradient-light);
            color: #0f172a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            transition: background 0.4s ease;
        }

        /* Orbes de fondo animados */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.45;
            z-index: 0;
            animation: floatOrb 10s infinite alternate ease-in-out;
        }
        .orb-1 {
            width: 300px;
            height: 300px;
            background: #6366f1;
            top: 10%;
            left: 15%;
        }
        .orb-2 {
            width: 350px;
            height: 350px;
            background: #a855f7;
            bottom: 10%;
            right: 15%;
            animation-delay: -5s;
        }

        @keyframes floatOrb {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(30px, -40px) scale(1.1); }
        }

        .animated-card {
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 1.75rem;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.4);
            animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        [data-bs-theme="light"] .animated-card {
            background: rgba(255, 255, 255, 0.75);
            border-color: rgba(255, 255, 255, 0.8);
        }

        [data-bs-theme="dark"] .animated-card {
            background: rgba(15, 23, 42, 0.65);
        }

        .icon-avatar {
            width: 76px;
            height: 76px;
            background: var(--primary-gradient);
            color: #ffffff;
            border-radius: 1.25rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            box-shadow: 0 12px 25px -5px rgba(99, 102, 241, 0.5);
            transform: rotate(-3deg);
            transition: transform 0.3s ease;
        }

        .animated-card:hover .icon-avatar {
            transform: rotate(0deg) scale(1.05);
        }

        .form-control, .form-select, .input-group-text {
            border-radius: 0.85rem;
            padding: 0.8rem 1rem;
        }

        .btn-gradient {
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 0.85rem;
            padding: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px -6px rgba(99, 102, 241, 0.6);
            color: white;
        }

        .theme-toggle {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 1000;
            border-radius: 50%;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center py-5">

    <!-- Elementos luminosos de fondo -->
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- Botón Conmutador de Tema -->
    <button class="btn btn-outline-secondary theme-toggle bg-body" id="themeSwitcher" title="Cambiar tema">
        <i class="bi bi-sun-fill" id="themeIcon"></i>
    </button>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card animated-card p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <div class="icon-avatar mb-3">
                            <i class="bi bi-car-front-fill"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Control de Vehículos</h3>
                        <p class="text-secondary small">Ingrese los datos para registrar el ingreso</p>
                    </div>

                    <form action="registro.php" method="POST" id="vehicleForm">
                        <!-- Campo Placa con Máscara JS -->
                        <div class="mb-3">
                            <label for="placa" class="form-label fw-semibold small text-uppercase opacity-75">Placa del Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                <input type="text" class="form-control text-uppercase" id="placa" name="placa" placeholder="ABC-1234" maxlength="8" required style="letter-spacing: 1.5px; font-weight: 700;">
                            </div>
                            <div class="form-text small opacity-50">Formato automático: AAA-0000</div>
                        </div>

                        <!-- Campo Tipo -->
                        <div class="mb-3">
                            <label for="tipo" class="form-label fw-semibold small text-uppercase opacity-75">Tipo de Vehículo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-truck"></i></span>
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="" disabled selected>Seleccione opción...</option>
                                    <option value="Automóvil">Automóvil</option>
                                    <option value="Motocicleta">Motocicleta</option>
                                    <option value="Camioneta">Camioneta</option>
                                    <option value="Camión">Camión</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>

                        <!-- Campo Hora con Autocompletado -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="hora" class="form-label fw-semibold small text-uppercase opacity-75 mb-0">Hora de Ingreso</label>
                                <button type="button" class="btn btn-link p-0 text-decoration-none small" id="setCurrentTime">
                                    <i class="bi bi-clock-fill me-1"></i>Hora actual
                                </button>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                                <input type="time" class="form-control" id="hora" name="hora" required>
                            </div>
                        </div>

                        <!-- Botón Submit -->
                        <button type="submit" class="btn btn-gradient w-100 fs-6">
                            <i class="bi bi-plus-circle-fill me-2"></i>Registrar Ingreso
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts Interactivos -->
    <script>
        // Interruptor Modo Oscuro / Claro
        const switcher = document.getElementById('themeSwitcher');
        const icon = document.getElementById('themeIcon');
        const html = document.documentElement;

        switcher.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
        });

        // Formateador automático para el campo Placa
        const placaInput = document.getElementById('placa');
        placaInput.addEventListener('input', (e) => {
            let val = e.target.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
            if (val.length > 3) {
                val = val.slice(0, 3) + '-' + val.slice(3, 7);
            }
            e.target.value = val;
        });

        // Botón de autocompletar hora actual
        document.getElementById('setCurrentTime').addEventListener('click', () => {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('hora').value = `${hours}:${minutes}`;
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
