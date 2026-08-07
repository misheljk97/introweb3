let armyMembers = [
    { id: 1, nombre: 'Camila Torres', bias: 'Jungkook', edad: 20, membresia: 'VIP' },
    { id: 2, nombre: 'Lucas Gómez', bias: 'Jimin', edad: 24, membresia: 'Estándar' }
];

let nextId = 3;
let isEditing = false;

// Elementos del DOM
const armyForm = document.getElementById('armyForm');
const memberIdInput = document.getElementById('memberId');
const nombreInput = document.getElementById('nombre');
const biasSelect = document.getElementById('bias');
const edadInput = document.getElementById('edad');
const tipoMembresiaSelect = document.getElementById('tipoMembresia');
const btnSave = document.getElementById('btnSave');
const btnCancel = document.getElementById('btnCancel');
const formTitle = document.getElementById('formTitle');
const armyTableBody = document.getElementById('armyTableBody');
const searchInput = document.getElementById('searchInput');
const sortSelect = document.getElementById('sortSelect');

const statTotal = document.getElementById('statTotal');
const statVIP = document.getElementById('statVIP');
const statAvgAge = document.getElementById('statAvgAge');

const btnExport = document.getElementById('btnExport');
const btnThemeToggle = document.getElementById('btnThemeToggle');

// Inicialización
document.addEventListener('DOMContentLoaded', () => {
    if (armyTableBody) {
        renderTable(armyMembers);
        updateStats();

        armyForm.addEventListener('submit', handleFormSubmit);
        btnCancel.addEventListener('click', resetForm);
        searchInput.addEventListener('input', handleSearch);
        sortSelect.addEventListener('change', handleSort);
        btnExport.addEventListener('click', exportSummary);
    }

    if (btnThemeToggle) {
        btnThemeToggle.addEventListener('click', toggleTheme);
    }
});

// Renderizar Tabla
function renderTable(data) {
    armyTableBody.innerHTML = '';

    if (data.length === 0) {
        armyTableBody.innerHTML = `<tr><td colspan="6" style="text-align:center;">No hay registros encontrados.</td></tr>`;
        return;
    }

    data.forEach(member => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${member.id}</td>
            <td>${member.nombre}</td>
            <td>${member.bias}</td>
            <td>${member.edad}</td>
            <td>${member.membresia}</td>
            <td>
                <button onclick="editMember(${member.id})" class="btn-secondary">Editar</button>
                <button onclick="deleteMember(${member.id})" class="btn-danger">Eliminar</button>
            </td>
        `;
        armyTableBody.appendChild(row);
    });
}

// Registro / Edición
function handleFormSubmit(e) {
    e.preventDefault();

    const nombre = nombreInput.value.trim();
    const bias = biasSelect.value;
    const edad = parseInt(edadInput.value, 10);
    const membresia = tipoMembresiaSelect.value;

    if (nombre === '' || bias === '' || isNaN(edad)) {
        alert('Por favor complete todos los campos requeridos correctamente.');
        return;
    }

    if (edad < 10 || edad > 100) {
        alert('Por favor ingrese una edad válida (10 - 100 años).');
        return;
    }

    if (isEditing) {
        const id = parseInt(memberIdInput.value, 10);
        const index = armyMembers.findIndex(m => m.id === id);
        if (index !== -1) {
            armyMembers[index] = { id, nombre, bias, edad, membresia };
        }
    } else {
        const newMember = { id: nextId++, nombre, bias, edad, membresia };
        armyMembers.push(newMember);
    }

    resetForm();
    renderTable(armyMembers);
    updateStats();
}

// Cargar para editar
window.editMember = function(id) {
    const member = armyMembers.find(m => m.id === id);
    if (!member) return;

    memberIdInput.value = member.id;
    nombreInput.value = member.nombre;
    biasSelect.value = member.bias;
    edadInput.value = member.edad;
    tipoMembresiaSelect.value = member.membresia;

    isEditing = true;
    formTitle.textContent = 'Editar Miembro ARMY';
    btnSave.textContent = 'Actualizar Miembro';
    btnCancel.hidden = false;
};

// Eliminar
window.deleteMember = function(id) {
    if (confirm('¿Está seguro de que desea eliminar este registro?')) {
        armyMembers = armyMembers.filter(m => m.id !== id);
        renderTable(armyMembers);
        updateStats();
        resetForm();
    }
};

// Reset
function resetForm() {
    armyForm.reset();
    memberIdInput.value = '';
    isEditing = false;
    formTitle.textContent = 'Registrar Nuevo Miembro';
    btnSave.textContent = 'Guardar Miembro';
    btnCancel.hidden = true;
}

// Buscar
function handleSearch() {
    const query = searchInput.value.toLowerCase();
    const filtered = armyMembers.filter(m => 
        m.nombre.toLowerCase().includes(query) || 
        m.bias.toLowerCase().includes(query)
    );
    renderTable(filtered);
}

// Ordenar
function handleSort() {
    const sortBy = sortSelect.value;
    let sorted = [...armyMembers];

    if (sortBy === 'nombre') {
        sorted.sort((a, b) => a.nombre.localeCompare(b.nombre));
    } else if (sortBy === 'edad') {
        sorted.sort((a, b) => a.edad - b.edad);
    }

    renderTable(sorted);
}

// Actualizar estadísticas
function updateStats() {
    const total = armyMembers.length;
    const vips = armyMembers.filter(m => m.membresia === 'VIP').length;
    
    let avgAge = 0;
    if (total > 0) {
        const sumAge = armyMembers.reduce((acc, m) => acc + m.edad, 0);
        avgAge = (sumAge / total).toFixed(1);
    }

    statTotal.textContent = total;
    statVIP.textContent = vips;
    statAvgAge.textContent = avgAge;
}

// Funcionalidades Adicionales
function exportSummary() {
    const total = armyMembers.length;
    if (total === 0) {
        alert('No hay datos registrados para exportar.');
        return;
    }
    const report = armyMembers.map(m => `- ${m.nombre} | Bias: ${m.bias} | Tipo: ${m.membresia}`).join('\n');
    alert(`--- REPORTE RÁPIDO DE MIEMBROS ---\nTotal: ${total}\n\n${report}`);
}

function toggleTheme() {
    document.body.classList.toggle('dark-mode');
}

// --- LÓGICA DE MODALES DE INFORMACIÓN Y BIOGRAFÍAS ---
const infoDefinitions = {
    musica: {
        titulo: "🎵 Música & Logros",
        texto: "BTS ha dejado una huella imborrable en la historia musical mundial. Desde su debut en 2013, han batido récords en listas como Billboard Hot 100, logrando nominaciones a los Premios Grammy y llenando estadios globales. Sus letras abordan temas profundos sobre la juventud, la salud mental y el amor propio ('Love Yourself')."
    },
    comunidad: {
        titulo: "💜 Comunidad ARMY",
        texto: "ARMY es el nombre del fandom oficial de BTS. Más que un grupo de seguidores, es un movimiento global caracterizado por la organización en redes sociales, iniciativas benéficas internacionales y la promoción de mensajes de inclusión y empatía promovidos por la banda junto a campañas con la UNICEF."
    },
    membresia: {
        titulo: "🪪 Membresía Oficial",
        texto: "Nuestra plataforma te permite registrar tu perfil dentro del club de fans para acceder a contenido exclusivo, acreditación digital como miembro oficial ARMY, participación en votaciones especiales y estadísticas de la comunidad local e internacional."
    }
};

const memberBios = {
    jin: {
        nombre: "Kim Seok-jin (Jin)",
        rol: "Vocalista / Visual",
        foto: "img/jin.jpg",
        bio: "Nacido el 4 de diciembre de 1992. Es el miembro de mayor edad de BTS. Destaca por su rango vocal suave, su carisma natural y su título no oficial de 'Worldwide Handsome'. Ha lanzado varios sencillos en solitario como 'Moon' y 'The Astronaut'."
    },
    suga: {
        nombre: "Min Yoon-gi (Suga / Agust D)",
        rol: "Rapeador Principal / Productor",
        foto: "img/suga.jpg",
        bio: "Nacido el 9 de marzo de 1993. Es un prolífico rapero, compositor y productor musical. Ha producido numerosas canciones tanto para BTS como para artistas internacionales. Bajo el seudónimo Agust D ha lanzado aclamados mixtapes."
    },
    jhope: {
        nombre: "Jung Ho-seok (J-Hope)",
        rol: "Bailarín Principal / Rapeador",
        foto: "img/j hope.jpg",
        bio: "Nacido el 18 de febrero de 1994. Es el bailarín principal y líder de coreografías del grupo. Su energía positiva y estilo único de rap lo caracterizan. Lanzó su álbum en solitario 'Jack in the Box' con gran éxito de crítica."
    },
    rm: {
        nombre: "Kim Nam-joon (RM)",
        rol: "Líder / Rapeador Principal",
        foto: "img/rm.jpg",
        bio: "Nacido el 12 de septiembre de 1994. Es el líder de BTS y el principal portavoz del grupo a nivel internacional gracias a su fluidez en inglés. Es compositor y apasionado del arte, conocido por sus profundas letras e introspección."
    },
    jimin: {
        nombre: "Park Ji-min (Jimin)",
        rol: "Bailarín Principal / Vocalista",
        foto: "img/jimin.jpg",
        bio: "Nacido el 13 de octubre de 1995. Destaca por sus elegantes movimientos de danza contemporánea y su distintiva voz aguda. Su sencillo 'Like Crazy' alcanzó los primeros puestos a nivel mundial en las listas de éxitos."
    },
    v: {
        nombre: "Kim Tae-hyung (V)",
        rol: "Vocalista / Visual",
        foto: "img/v.jpg",
        bio: "Nacido el 30 de diciembre de 1995. Posee una voz barítono profunda y expresiva. Es conocido por su estilo de moda único y su amor por la fotografía y el jazz. Debutó en solitario con el álbum 'Layover'."
    },
    jungkook: {
        nombre: "Jeon Jung-kook (Jungkook)",
        rol: "Vocalista Principal / Centro",
        foto: "img/jk.jpg",
        bio: "Nacido el 1 de septiembre de 1997. Es el miembro más joven ('Golden Maknae'). Destaca por sus habilidades en canto, baile y producción. Su álbum 'Golden' y el sencillo 'Seven' rompieron récords globales de reproducciones."
    }
};

function showInfoModal(key) {
    const info = infoDefinitions[key];
    if (!info) return;
    document.getElementById('infoModalTitle').textContent = info.titulo;
    document.getElementById('infoModalText').textContent = info.texto;
    document.getElementById('infoModal').style.display = 'flex';
}

function closeInfoModal() {
    document.getElementById('infoModal').style.display = 'none';
}

function showBio(memberKey) {
    const member = memberBios[memberKey];
    if (!member) return;
    document.getElementById('modalImg').src = member.foto;
    document.getElementById('modalName').textContent = member.nombre;
    document.getElementById('modalRole').textContent = member.rol;
    document.getElementById('modalBio').textContent = member.bio;
    document.getElementById('bioModal').style.display = 'flex';
}

function closeBio() {
    document.getElementById('bioModal').style.display = 'none';
}

window.addEventListener('click', function(event) {
    const bioModal = document.getElementById('bioModal');
    const infoModal = document.getElementById('infoModal');
    if (event.target === bioModal) closeBio();
    if (event.target === infoModal) closeInfoModal