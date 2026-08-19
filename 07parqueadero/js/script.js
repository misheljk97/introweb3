document.addEventListener('DOMContentLoaded', function () {
  const parkingForm = document.getElementById('parkingForm');
  const placaInput = document.getElementById('placa');
  const tipoSelect = document.getElementById('tipo');
  const clienteInput = document.getElementById('cliente');
  const horaIngresoInput = document.getElementById('horaIngreso');
  const tablaVehiculos = document.getElementById('tablaVehiculos');
  const alertContainer = document.getElementById('alertContainer');
  const emptyState = document.getElementById('emptyState');
  const contadorVehiculos = document.getElementById('contadorVehiculos');

  let vehiculosActivos = 0;

  // Asignar hora actual por defecto al cargar
  actualizarHoraActual();

  parkingForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const placa = placaInput.value.trim().toUpperCase();
    const tipo = tipoSelect.value;
    const cliente = clienteInput.value.trim();
    const horaIngreso = horaIngresoInput.value;

    // Validación básica con alerta personalizada estilo warning
    if (!placa || !tipo || !cliente || !horaIngreso) {
      mostrarAlerta('<i class="bi bi-exclamation-triangle-fill me-2"></i> Por favor, completa todos los campos del formulario.', 'warning');
      return;
    }

    // Configurar Insignia según tipo de vehículo
    let badgeClass = 'bg-primary-subtle text-primary';
    let iconTipo = 'bi-car-front-fill';

    if (tipo === 'Motocicleta') {
      badgeClass = 'bg-warning-subtle text-warning-emphasis';
      iconTipo = 'bi-bicycle';
    } else if (tipo === 'Camioneta') {
      badgeClass = 'bg-info-subtle text-info-emphasis';
      iconTipo = 'bi-truck-front-fill';
    }

    // Crear fila con estilos modernos
    const tr = document.createElement('tr');
    tr.setAttribute('data-timestamp', Date.now());

    tr.innerHTML = `
      <td class="ps-4 text-start fw-bold text-dark">
        <span class="d-inline-flex align-items-center gap-2">
          <i class="bi bi-card-text text-secondary"></i> ${placa}
        </span>
      </td>
      <td>
        <span class="badge badge-vehiculo ${badgeClass}">
          <i class="bi ${iconTipo} me-1"></i> ${tipo}
        </span>
      </td>
      <td class="text-secondary fw-medium">${cliente}</td>
      <td>
        <span class="badge bg-light text-dark border">
          <i class="bi bi-clock me-1 text-primary"></i> ${horaIngreso}
        </span>
      </td>
      <td class="text-end pe-4">
        <button class="btn btn-outline-danger btn-sm btn-danger-custom d-inline-flex align-items-center gap-1 btn-salida">
          <i class="bi bi-box-arrow-right"></i> Dar Salida
        </button>
      </td>
    `;

    // Evento botón salir
    tr.querySelector('.btn-salida').addEventListener('click', function () {
      const tiempoInicio = parseInt(tr.getAttribute('data-timestamp'));
      const tiempoFin = Date.now();
      
      let diffMinutos = Math.ceil((tiempoFin - tiempoInicio) / (1000 * 60));
      if (diffMinutos <= 0) diffMinutos = 1; 

      // Tarifa: 0.50 por cada 30 min o fracción
      const fracciones = Math.ceil(diffMinutos / 30);
      const monto = (fracciones * 0.50).toFixed(2);

      tr.remove();
      vehiculosActivos--;
      actualizarEstadoTabla();

      mostrarAlerta(
        `<i class="bi bi-check-circle-fill me-2"></i> Salida confirmada para <strong>${placa}</strong>.<br>` +
        `<small class="mt-1 d-block">Permanencia: <strong>${diffMinutos} min</strong> | Cobro: <strong class="text-success">$${monto} USD</strong></small>`,
        'info'
      );
    });

    tablaVehiculos.appendChild(tr);
    vehiculosActivos++;
    actualizarEstadoTabla();

    // Notificación de éxito y reseteo de campos
    mostrarAlerta(`<i class="bi bi-check-circle-fill me-2"></i> Vehículo <strong>${placa}</strong> registrado correctamente.`, 'success');
    parkingForm.reset();
    actualizarHoraActual();
  });

  function actualizarEstadoTabla() {
    if (vehiculosActivos > 0) {
      emptyState.classList.add('d-none');
    } else {
      emptyState.classList.remove('d-none');
    }
    contadorVehiculos.innerHTML = `<i class="bi bi-car-front-fill me-1 text-primary"></i> ${vehiculosActivos} Ocupados`;
  }

  function mostrarAlerta(mensaje, tipo) {
    alertContainer.innerHTML = `
      <div class="alert alert-${tipo} alert-dismissible fade show shadow-sm border-0 rounded-3 mb-4" role="alert">
        <div>${mensaje}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `;

    setTimeout(() => {
      alertContainer.innerHTML = '';
    }, 6000);
  }

  function actualizarHoraActual() {
    const ahora = new Date();
    const horas = String(ahora.getHours()).padStart(2, '0');
    const minutos = String(ahora.getMinutes()).padStart(2, '0');
    horaIngresoInput.value = `${horas}:${minutos}`;
  }
});