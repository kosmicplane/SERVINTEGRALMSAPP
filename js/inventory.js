$(document).ready(function() {
    buildInventoryPanel();
});

function buildInventoryPanel() {
    var panel = $("#inventoryPanel");
    if (!panel.length) { return; }

    panel.hide();

    $("#inventoryToggle").on('click', function() {
        panel.toggle();
        if (panel.is(':visible')) {
            loadMovementList();
        }
    });

    $("#inventoryMovementForm").on('submit', function(e) {
        e.preventDefault();
        registerMovement();
    });

    $("#exportMovementsBtn").on('click', function() {
        exportMovements();
    });
}

function registerMovement() {
    var payload = {
        item_code: $("#invItemCode").val(),
        description: $("#invItemDesc").val(),
        movement_code: $("#invMovementType").val(),
        quantity: parseFloat($("#invQuantity").val()),
        unit_cost: parseFloat($("#invUnitCost").val()),
        notes: $("#invNotes").val()
    };

    $.ajax({
        url: 'inventory_api.php?action=register_movement',
        method: 'POST',
        data: JSON.stringify(payload),
        contentType: 'application/json',
        success: function(resp) {
            if (resp.status === 'ok') {
                $("#inventoryStatus").text('Movimiento registrado. Stock: ' + resp.data.stock + ' | Costo promedio: ' + resp.data.avg_cost.toFixed(2));
                loadMovementList();
            } else {
                $("#inventoryStatus").text(resp.message || 'No se pudo registrar');
            }
        },
        error: function(xhr) {
            var msg = 'Error inesperado';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            $("#inventoryStatus").text(msg);
        }
    });
}

function loadMovementList() {
    var params = {
        action: 'list_movements',
        item_code: $("#filterItemCode").val(),
        movement_code: $("#filterMovementType").val(),
        from: $("#filterFrom").val(),
        to: $("#filterTo").val()
    };

    $.getJSON('inventory_api.php', params, function(resp) {
        var body = $("#inventoryMovementsBody");
        body.empty();
        if (resp.status !== 'ok') {
            body.append('<tr><td colspan="6">No autorizado o sin datos</td></tr>');
            return;
        }
        resp.data.forEach(function(row) {
            var tr = $('<tr></tr>');
            tr.append('<td>' + row.id + '</td>');
            tr.append('<td>' + row.item_code + '</td>');
            tr.append('<td>' + row.name + '</td>');
            tr.append('<td>' + row.direction + '</td>');
            tr.append('<td>' + row.quantity + '</td>');
            tr.append('<td>' + row.created_at + '</td>');
            body.append(tr);
        });
        if (!resp.data.length) {
            body.append('<tr><td colspan="6">Sin movimientos</td></tr>');
        }
    });
}

function exportMovements() {
    var query = $.param({
        action: 'export_movements',
        item_code: $("#filterItemCode").val(),
        movement_code: $("#filterMovementType").val(),
        from: $("#filterFrom").val(),
        to: $("#filterTo").val()
    });
    window.location = 'inventory_api.php?' + query;
}
