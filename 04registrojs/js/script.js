document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("formulario");
    const tablaCuerpo = document.getElementById("tablaCuerpo");
    const btnAgregar = document.getElementById("btnAgregar");
    const btnCancelar = document.getElementById("btnCancelar");
    const formTitulo = document.getElementById("formTitulo");

    let filaEnEdicion = null; // Variable para saber si estamos editando una fila

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const nombres = document.getElementById("txtNombre").value.trim();
        const apellidos = document.getElementById("txtApellido").value.trim();
        const correo = document.getElementById("txtCorreo").value.trim();
        const edad = document.getElementById("txtEdad").value.trim();

        // Validaciones
        if (!nombres || !apellidos || !correo || !edad) {
            alert("Por favor, completa todos los campos.");
            return;
        }

        if (parseInt(edad) <= 0 || parseInt(edad) > 120) {
            alert("Por favor, ingresa una edad válida.");
            return;
        }

        if (filaEnEdicion) {
            // MODO EDICIÓN: Actualizar fila existente
            filaEnEdicion.cells[0].textContent = nombres;
            filaEnEdicion.cells[1].textContent = apellidos;
            filaEnEdicion.cells[2].textContent = correo;
            filaEnEdicion.cells[3].textContent = edad;

            resetearEstadoFormulario();
        } else {
            // MODO AGREGAR: Crear nueva fila
            const nuevaFila = document.createElement("tr");

            nuevaFila.innerHTML = `
                <td>${nombres}</td>
                <td>${apellidos}</td>
                <td>${correo}</td>
                <td>${edad}</td>
                <td>
                    <button class="btn-accion btn-editar">✏️ Editar</button>
                    <button class="btn-accion btn-eliminar">🗑️ Borrar</button>
                </td>
            `;

            tablaCuerpo.appendChild(nuevaFila);
            form.reset();
        }
    });

    // Delegación de eventos para los botones Editar y Borrar en la tabla
    tablaCuerpo.addEventListener("click", function (e) {
        const boton = e.target;
        const fila = boton.closest("tr");

        // ACCIÓN BORRAR
        if (boton.classList.contains("btn-eliminar")) {
            if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
                fila.remove();
                if (filaEnEdicion === fila) {
                    resetearEstadoFormulario();
                }
            }
        }

        // ACCIÓN EDITAR
        if (boton.classList.contains("btn-editar")) {
            filaEnEdicion = fila;

            // Cargar datos de la fila seleccionada en los inputs
            document.getElementById("txtNombre").value = fila.cells[0].textContent;
            document.getElementById("txtApellido").value = fila.cells[1].textContent;
            document.getElementById("txtCorreo").value = fila.cells[2].textContent;
            document.getElementById("txtEdad").value = fila.cells[3].textContent;

            // Cambiar textos e interfaz a Modo Edición
            formTitulo.textContent = "✏️ Editar Persona";
            btnAgregar.textContent = "Guardar Cambios";
            btnCancelar.style.display = "block";
        }
    });

    // Botón para cancelar la edición
    btnCancelar.addEventListener("click", function () {
        resetearEstadoFormulario();
    });

    // Función auxiliar para restablecer el formulario
    function resetearEstadoFormulario() {
        form.reset();
        filaEnEdicion = null;
        formTitulo.textContent = "➕ Registrar Persona";
        btnAgregar.textContent = "Agregar Registro";
        btnCancelar.style.display = "none";
    }
});