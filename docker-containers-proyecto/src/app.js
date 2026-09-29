// Archivo de ejemplo: app.js
// Cliente JavaScript para consumir API PHP

const API_URL = 'http://localhost/api.php';

// Obtener usuarios de la API
async function obtenerUsuarios() {
    try {
        const response = await fetch(`${API_URL}?action=usuarios`);
        const data = await response.json();
        
        console.log('Usuarios obtenidos:', data);
        
        if (data.datos && data.datos.length > 0) {
            mostrarUsuarios(data.datos);
        } else {
            console.log('No hay usuarios');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Mostrar usuarios en la página
function mostrarUsuarios(usuarios) {
    const lista = document.getElementById('usuarios-list');
    if (!lista) return;
    
    lista.innerHTML = '';
    usuarios.forEach(usuario => {
        const item = document.createElement('li');
        item.textContent = `${usuario.nombre} - ${usuario.email}`;
        lista.appendChild(item);
    });
}

// Ejecutar al cargar la página
document.addEventListener('DOMContentLoaded', obtenerUsuarios);
