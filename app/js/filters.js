function applyOrderFilters() {
    const dateFilter = document.getElementById('filter-date').value;
    const authorFilter = document.getElementById('filter-author').value.toLowerCase();
    const statusFilter = document.getElementById('filter-status').value.toLowerCase();

    const table = document.getElementById('ordersTable'); // ID de la tabla
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) { // Saltar la cabecera
        const cells = rows[i].getElementsByTagName('td');
        const date = cells[6]?.textContent || ''; // Fecha Creación
        const author = cells[10]?.textContent.toLowerCase() || ''; // Autor
        const status = cells[9]?.textContent.toLowerCase() || ''; // Estado

        const matchesDate = !dateFilter || date.includes(dateFilter);
        const matchesAuthor = !authorFilter || author.includes(authorFilter);
        const matchesStatus = !statusFilter || status.includes(statusFilter);

        if (matchesDate && matchesAuthor && matchesStatus) {
            rows[i].style.display = ''; // Mostrar fila
        } else {
            rows[i].style.display = 'none'; // Ocultar fila
        }
    }
}