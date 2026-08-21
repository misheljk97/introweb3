<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Registro</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --bg-gradient-dark: #090d16;
            --bg-gradient-light: #f1f5f9;
        }

        [data-bs-theme="dark"] body { background-color: var(--bg-gradient-dark); color: #f8fafc; }
        [data-bs-theme="light"] body { background-color: var(--bg-gradient-light); color: #0f172a; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            transition: background 0.4s ease;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: 0.45;
            z-index: 0;
            animation: floatOrb 10s infinite alternate ease-in-out;
        }
        .orb-1 { width: 300px; height: 300px; background: #10b981; top: 10%; left: 15%; }
        .orb-2 { width: 350px; height: 350px; background: #6366f1; bottom: 10%; right: 15%; animation-delay: -5s; }

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

        [data-bs-theme="light"] .animated-card { background: rgba(255, 255, 255, 0.75); border-color: rgba(255, 255, 255, 0.8); }
        [data-bs-theme="dark"] .animated-card { background: rgba(15, 23, 42, 0.65); }

        .data-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.25rem;
            padding: 1.25rem;
        }

        [data-bs-theme="light"] .data-card {
            background: rgba(0, 0, 0, 0.03);
            border-color: rgba(0, 0, 0, 0.08);
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

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <button class="btn btn-outline-secondary theme-toggle bg-body" id="themeSwitcher">
        <i class="bi bi-sun-fill" id="themeIcon"></i>
    </button>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                <div class="card animated-card p-4 p-md-5">

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    
                    $placa = isset($_POST['placa']) ? trim($_POST['placa']) : '';
                    $tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : '';
                    $hora = isset($_POST['hora']) ? trim($_POST['hora']) : '';

                    if (empty($placa) || empty($tipo) || empty($hora)) {
                        ?>
                        <div class="text-center">
                            <div class="text-danger mb-3 display-4">
                                <i class="bi bi-exclamation-octagon-fill"></i>
                            </div>
                            <h4 class="fw-bold mb-2">Campos Incompletos</h4>
                            <p class="text-secondary small mb-4">No se pudo procesar el registro.</p>
                            
                            <div class="alert alert-danger border-0 bg-danger-subtle text-danger rounded-4 p-3 mb-4 text-start small">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>Por favor llene todos los datos obligatorios.
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="text-center mb-4">
                            <div class="text-success mb-2 display-3">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <h3 class="fw-bold mb-1">¡Registro Confirmado!</h3>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill small">Ingreso Guardado</span>
                        </div>

                        <div class="data-card mb-4">
                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                                <span class="text-secondary small"><i class="bi bi-card-heading me-2 text-primary"></i>Placa</span>
                                <span class="badge bg-primary fs-6 px-3 py-2 font-monospace" style="letter-spacing: 1px;"><?php echo htmlspecialchars(strtoupper($placa)); ?></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom border-secondary-subtle">
                                <span class="text-secondary small"><i class="bi bi-truck me-2 text-primary"></i>Vehículo</span>
                                <span class="fw-bold"><?php echo htmlspecialchars($tipo); ?></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center py-2 pt-3">
                                <span class="text-secondary small"><i class="bi bi-clock me-2 text-primary"></i>Hora</span>
                                <span class="fw-bold text-success fs-6"><?php echo htmlspecialchars($hora); ?></span>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="text-center">
                        <div class="text-warning mb-3 display-4">
                            <i class="bi bi-shield-slash-fill"></i>
                        </div>
                        <h4 class="fw-bold mb-2">Acceso No Autorizado</h4>
                        <p class="text-secondary small mb-4">Debe enviar la información desde el formulario de inicio.</p>
                    </div>
                    <?php
                }
                ?>

                <a href="index.php" class="btn btn-outline-primary w-100 py-2 rounded-3 fw-semibold text-decoration-none text-center">
                    <i class="bi bi-arrow-left me-2"></i>Regresar al Inicio
                </a>

                </div>
            </div>
        </div>
    </div>

    <script>
        const switcher = document.getElementById('themeSwitcher');
        const icon = document.getElementById('themeIcon');
        const html = document.documentElement;

        switcher.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-bs-theme', newTheme);
            icon.className = newTheme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>