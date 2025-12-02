function parseRqItems(raw) {
    if (!raw) return [];
    return raw.split('\n').filter(Boolean).map(function (line) {
        var parts = line.split('|');
        return {
            sku: (parts[0] || '').trim(),
            description: (parts[1] || '').trim(),
            qty: parseFloat(parts[2] || '0'),
            unit_cost: parseFloat(parts[3] || '0'),
            source: (parts[4] || '').trim() || 'warehouse'
        };
    });
}

function submitRqForm() {
    var payload = {
        action: 'create',
        type: document.getElementById('rqType').value,
        order_code: document.getElementById('rqOrder').value,
        requester: document.getElementById('rqRequester').value,
        notes: document.getElementById('rqNotes').value,
        items: JSON.stringify(parseRqItems(document.getElementById('rqItems').value))
    };
    $.post('libs/php/rq.php', payload, function (resp) {
        try { resp = JSON.parse(resp); } catch (e) {}
        if (resp.status) {
            document.getElementById('rqResult').innerHTML = 'RQ creada: ' + resp.code;
            loadRqList();
        } else {
            document.getElementById('rqResult').innerHTML = 'Error: ' + resp.message;
        }
    });
}

function loadRqList() {
    var payload = {
        action: 'list',
        order_code: document.getElementById('rqFilterOrder').value
    };
    $.post('libs/php/rq.php', payload, function (resp) {
        try { resp = JSON.parse(resp); } catch (e) {}
        if (!resp.status) {
            document.getElementById('rqList').innerHTML = resp.message || 'Error cargando RQ';
            return;
        }
        var html = '';
        resp.data.forEach(function (rq) {
            html += '<div class="rqCard">';
            html += '<div><strong>RQ:</strong> ' + rq.CODE + ' (' + rq.TYPE + ')</div>';
            html += '<div><strong>OT:</strong> ' + rq.ORDER_CODE + '</div>';
            html += '<div><strong>Estado:</strong> ' + rq.STATE + '</div>';
            html += '<div><strong>Solicita:</strong> ' + rq.REQUESTER + '</div>';
            html += '<div><strong>Notas:</strong> ' + (rq.NOTES || '') + '</div>';
            html += '<div class="rqActions">';
            html += '<button onclick="approveRq(\'' + rq.CODE + '\')">Aprobar</button>';
            html += '<button onclick="attendRq(\'' + rq.CODE + '\')">Atender</button>';
            html += '</div>';
            html += '<div class="rqItems">';
            rq.ITEMS.forEach(function (item) {
                html += '<div>- ' + item.SKU + ' (' + item.QTY + ') $' + item.UNIT_COST + '</div>';
            });
            html += '</div>';
            html += '<div class="rqHistory">';
            rq.HISTORY.forEach(function (h) {
                html += '<div>' + h.STATE + ' - ' + h.CHANGED_BY + '</div>';
            });
            html += '</div>';
            html += '</div>';
        });
        document.getElementById('rqList').innerHTML = html || 'Sin resultados';
    });
}

function approveRq(code) {
    var approver = document.getElementById('rqActor').value;
    $.post('libs/php/rq.php', { action: 'approve', code: code, approver: approver }, function (resp) {
        try { resp = JSON.parse(resp); } catch (e) {}
        document.getElementById('rqResult').innerHTML = resp.status ? 'RQ aprobada' : 'Error: ' + resp.message;
        loadRqList();
    });
}

function attendRq(code) {
    var actor = document.getElementById('rqActor').value;
    $.post('libs/php/rq.php', { action: 'attend', code: code, attended_by: actor }, function (resp) {
        try { resp = JSON.parse(resp); } catch (e) {}
        document.getElementById('rqResult').innerHTML = resp.status ? 'RQ atendida. Costo: ' + resp.total : 'Error: ' + resp.message;
        loadRqList();
    });
}

function linkRqToOt() {
    var code = document.getElementById('rqLinkCode').value;
    var order = document.getElementById('rqLinkOrder').value;
    var actor = document.getElementById('rqActor').value;
    $.post('libs/php/rq.php', { action: 'link-ot', code: code, order_code: order, autor: actor }, function (resp) {
        try { resp = JSON.parse(resp); } catch (e) {}
        document.getElementById('rqResult').innerHTML = resp.status ? 'RQ vinculada' : 'Error: ' + resp.message;
        loadRqList();
    });
}

document.addEventListener('DOMContentLoaded', function () {
    var btnCreate = document.getElementById('rqCreateBtn');
    if (btnCreate) {
        btnCreate.addEventListener('click', submitRqForm);
        document.getElementById('rqRefreshBtn').addEventListener('click', loadRqList);
        document.getElementById('rqLinkBtn').addEventListener('click', linkRqToOt);
    }
});
