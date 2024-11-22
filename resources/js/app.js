import './bootstrap';

import Alpine from 'alpinejs';

import Sortable from 'sortablejs'; 



// Inicializa Sortable en el contenedor que deseas hacer arrastrable
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('sortable-container');
    Sortable.create(container, {
        animation: 150,
        ghostClass: 'sortable-ghost', // Clase para el elemento que se está arrastrando
        onEnd: function (evt) {
            console.log('Elemento movido de ' + evt.oldIndex + ' a ' + evt.newIndex);
            // Aquí puedes agregar lógica para guardar el nuevo orden en el servidor si es necesario
        }
    });
});






window.Alpine = Alpine;

Alpine.start();
