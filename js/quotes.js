let quoteInitialized = false;
let catalogItems = [];
let quoteClients = [];
let quoteBranches = [];

function activateQuotes() {
    const container = document.getElementById('quoteModule');
    if (!container) {
        return;
    }

    if (!quoteInitialized) {
        renderQuoteUI(container);
        quoteInitialized = true;
    }

    container.style.display = 'block';
    loadQuotesList();
}

function deactivateQuotes() {
    const container = document.getElementById('quoteModule');
    if (container) {
        container.style.display = 'none';
    }
}

function renderQuoteUI(container) {
    container.innerHTML = [
        '<h3>Gestión de Cotizaciones</h3>',
        '<div class="panel panel-default">',
        '  <div class="panel-heading clearfix">',
        '    <span>Listado de cotizaciones</span>',
        '    <button class="btn btn-primary btn-sm pull-right" id="newQuoteBtn">Nueva cotización</button>',
        '  </div>',
        '  <div class="panel-body">',
        '    <div id="quoteListEmpty" class="alert alert-info" style="display:none;">No hay cotizaciones registradas.</div>',
        '    <table id="quoteList" class="table table-bordered">',
        '      <thead><tr><th>Código</th><th>Cliente</th><th>Fecha</th><th>Estado</th><th>Total</th></tr></thead>',
        '      <tbody></tbody>',
        '    </table>',
        '  </div>',
        '</div>',
        '<div class="row">',
        '  <div class="col-md-6">',
        '    <label>Código de cotización</label>',
        '    <input id="quoteCode" class="form-control" placeholder="Autogenerado" disabled />',
        '  </div>',
        '  <div class="col-md-3">',
        '    <label>Cliente</label>',
        '    <select id="quoteClient" class="form-control"></select>',
        '  </div>',
        '  <div class="col-md-3">',
        '    <label>Nombre de cliente</label>',
        '    <input id="quoteClientName" class="form-control" placeholder="Razón social" readonly />',
        '  </div>',
        '</div>',
        '<div class="row" style="margin-top:10px;">',
        '  <div class="col-md-3">',
        '    <label>Sucursal</label>',
        '    <select id="quoteSucu" class="form-control"></select>',
        '  </div>',
        '  <div class="col-md-3">',
        '    <label>Nombre sucursal</label>',
        '    <input id="quoteSucuName" class="form-control" placeholder="Nombre sucursal" readonly />',
        '  </div>',
        '  <div class="col-md-3">',
        '    <label>Contacto</label>',
        '    <input id="quoteContact" class="form-control" placeholder="Correo/Teléfono" />',
        '  </div>',
        '  <div class="col-md-3">',
        '    <label>Validez</label>',
        '    <input id="quoteValid" type="date" class="form-control" />',
        '  </div>',
        '</div>',
        '<div class="row" style="margin-top:10px;">',
        '  <div class="col-md-3">',
        '    <label>Moneda</label>',
        '    <input id="quoteCurrency" class="form-control" value="COP" />',
        '  </div>',
        '  <div class="col-md-9">',
        '    <label>Notas</label>',
        '    <textarea id="quoteNotes" class="form-control" rows="2"></textarea>',
        '  </div>',
        '</div>',
        '<hr>',
        '<div class="row">',
        '  <div class="col-md-12">',
        '    <label>Detalle de ítems y servicios</label>',
        '    <table id="quoteItems" class="table table-bordered">',
        '      <thead><tr><th>Código</th><th>Descripción</th><th>Tipo</th><th>Cant.</th><th>Precio Unit.</th><th>IVA %</th><th>Inventario</th><th></th></tr></thead>',
        '      <tbody></tbody>',
        '    </table>',
        '    <button class="btn btn-default" id="addItemRow">Agregar ítem</button>',
        '  </div>',
        '</div>',
        '<div class="row" style="margin-top:10px;">',
        '  <div class="col-md-6">',
        '    <label>Costos internos</label>',
        '    <table id="internalCosts" class="table table-bordered">',
        '      <thead><tr><th>Tipo</th><th>Monto</th><th>Nota</th><th></th></tr></thead>',
        '      <tbody></tbody>',
        '    </table>',
        '    <button class="btn btn-default" id="addCostRow">Agregar costo interno</button>',
        '  </div>',
        '  <div class="col-md-6">',
        '    <label>Estado</label>',
        '    <div id="quoteStatus" class="well">Borrador</div>',
        '    <label>Comentario de cambio de estado</label>',
        '    <textarea id="statusComment" class="form-control" rows="2"></textarea>',
        '  </div>',
        '</div>',
        '<div class="row" style="margin-top:10px;">',
        '  <div class="col-md-12">',
        '    <button class="btn btn-primary" id="saveQuote">Crear/Actualizar</button>',
        '    <button class="btn btn-info" id="sendQuote">Enviar</button>',
        '    <button class="btn btn-success" id="approveQuote">Aprobar y crear OT</button>',
        '    <button class="btn btn-danger" id="rejectQuote">Rechazar</button>',
        '  </div>',
        '</div>',
        '<div id="quoteAlert" class="alert" style="display:none; margin-top:10px;"></div>'
    ].join('');

    document.getElementById('newQuoteBtn').addEventListener('click', resetQuoteForm);
    document.getElementById('addItemRow').addEventListener('click', addItemRow);
    document.getElementById('addCostRow').addEventListener('click', addCostRow);
    document.getElementById('saveQuote').addEventListener('click', saveQuote);
    document.getElementById('sendQuote').addEventListener('click', () => changeStatus('sendQuote'));
    document.getElementById('approveQuote').addEventListener('click', () => changeStatus('approveQuote'));
    document.getElementById('rejectQuote').addEventListener('click', () => changeStatus('rejectQuote'));

    setupClientBranchSync();
    resetQuoteForm();
    loadCatalog();
    loadClientOptions();
    loadBranchOptions('');
}

function setupClientBranchSync() {
    const clientSelect = document.getElementById('quoteClient');
    const branchSelect = document.getElementById('quoteSucu');

    if (clientSelect) {
        clientSelect.addEventListener('change', () => {
            syncClientFields();
            loadBranchOptions(clientSelect.value);
        });
    }

    if (branchSelect) {
        branchSelect.addEventListener('change', syncBranchFields);
    }
}

function syncClientFields() {
    const clientSelect = document.getElementById('quoteClient');
    const clientName = document.getElementById('quoteClientName');
    const selected = clientSelect && clientSelect.selectedOptions.length > 0
        ? clientSelect.selectedOptions[0]
        : null;

    if (clientName) {
        clientName.value = selected ? selected.textContent : '';
    }
}

function syncBranchFields() {
    const branchSelect = document.getElementById('quoteSucu');
    const branchName = document.getElementById('quoteSucuName');
    const selected = branchSelect && branchSelect.selectedOptions.length > 0
        ? branchSelect.selectedOptions[0]
        : null;

    if (branchName) {
        branchName.value = selected ? selected.textContent : '';
    }
}

function ensureOption(select, value, label) {
    if (!select || value === undefined || value === null || value === '') {
        return;
    }
    const found = Array.prototype.find.call(select.options || [], opt => String(opt.value) === String(value));
    if (!found) {
        const option = document.createElement('option');
        option.value = value;
        option.textContent = label || value;
        select.appendChild(option);
    }
}

function resetQuoteForm() {
    const code = document.getElementById('quoteCode');
    if (code) { code.value = ''; }
    const client = document.getElementById('quoteClient');
    if (client) { client.value = ''; }
    const clientName = document.getElementById('quoteClientName');
    if (clientName) { clientName.value = ''; }
    const sucu = document.getElementById('quoteSucu');
    if (sucu) { sucu.value = ''; }
    const sucuName = document.getElementById('quoteSucuName');
    if (sucuName) { sucuName.value = ''; }
    const contact = document.getElementById('quoteContact');
    if (contact) { contact.value = ''; }
    const valid = document.getElementById('quoteValid');
    if (valid) { valid.value = ''; }
    const notes = document.getElementById('quoteNotes');
    if (notes) { notes.value = ''; }
    const currency = document.getElementById('quoteCurrency');
    if (currency) { currency.value = 'COP'; }
    const comment = document.getElementById('statusComment');
    if (comment) { comment.value = ''; }
    const status = document.getElementById('quoteStatus');
    if (status) { status.textContent = 'Borrador'; }

    const itemsBody = document.querySelector('#quoteItems tbody');
    const costBody = document.querySelector('#internalCosts tbody');
    if (itemsBody) { itemsBody.innerHTML = ''; }
    if (costBody) { costBody.innerHTML = ''; }
    addItemRow();
    addCostRow();

    const alertBox = document.getElementById('quoteAlert');
    if (alertBox) {
        alertBox.style.display = 'none';
    }
}

function addItemRow(prefill) {
    const tbody = document.querySelector('#quoteItems tbody');
    if (!tbody) {
        return;
    }
    const row = document.createElement('tr');
    row.innerHTML = [
        `<td><input class="form-control code" value="${prefill ? prefill.code : ''}" list="catalogCodes" /></td>`,
        `<td><input class="form-control desc" value="${prefill ? prefill.desc : ''}" /></td>`,
        `<td><select class="form-control type"><option value="item">Ítem</option><option value="servicio">Servicio</option></select></td>`,
        `<td><input class="form-control qty" type="number" min="0" step="0.01" value="${prefill ? prefill.qty : '1'}" /></td>`,
        `<td><input class="form-control unitPrice" type="number" min="0" step="0.01" value="${prefill ? prefill.unitPrice : '0'}" /></td>`,
        `<td><input class="form-control tax" type="number" min="0" step="0.01" value="${prefill ? prefill.tax : '0'}" /></td>`,
        `<td><input class="form-control inventoryCode" value="${prefill ? prefill.inventoryCode : ''}" /></td>`,
        '<td><button class="btn btn-link text-danger removeRow">X</button></td>'
    ].join('');
    row.querySelector('.type').value = prefill && prefill.type ? prefill.type : 'item';
    row.querySelector('.removeRow').addEventListener('click', () => row.remove());
    attachItemRowEvents(row);
    tbody.appendChild(row);
}

function attachItemRowEvents(row) {
    const codeInput = row.querySelector('.code');
    if (codeInput) {
        codeInput.addEventListener('change', () => fillRowFromCatalog(codeInput.value, row));
        codeInput.setAttribute('list', 'catalogCodes');
    }
}

function fillRowFromCatalog(code, row) {
    if (!code || !row || catalogItems.length === 0) {
        return;
    }

    const catalogItem = catalogItems.find(item => String(item.CODE) === String(code));
    if (!catalogItem) {
        return;
    }

    const desc = row.querySelector('.desc');
    const type = row.querySelector('.type');
    const inventory = row.querySelector('.inventoryCode');
    const unitPrice = row.querySelector('.unitPrice');

    if (desc) {
        desc.value = catalogItem.NAME || '';
    }

    if (type && catalogItem.TYPE) {
        const normalized = catalogItem.TYPE.toLowerCase().includes('serv') ? 'servicio' : 'item';
        type.value = normalized;
    }

    if (inventory) {
        inventory.value = catalogItem.INVENTORY_CODE || '';
    }

    if (unitPrice && Object.prototype.hasOwnProperty.call(catalogItem, 'DEFAULT_PRICE')) {
        unitPrice.value = catalogItem.DEFAULT_PRICE;
    }
}

function addCostRow(prefill) {
    const tbody = document.querySelector('#internalCosts tbody');
    if (!tbody) {
        return;
    }
    const row = document.createElement('tr');
    row.innerHTML = [
        `<td><input class="form-control costType" value="${prefill ? prefill.type : ''}" placeholder="Ej: Mano de obra" /></td>`,
        `<td><input class="form-control costAmount" type="number" min="0" step="0.01" value="${prefill ? prefill.amount : '0'}"/></td>`,
        `<td><input class="form-control costNote" value="${prefill ? prefill.note : ''}" /></td>`,
        '<td><button class="btn btn-link text-danger removeRow">X</button></td>'
    ].join('');
    row.querySelector('.removeRow').addEventListener('click', () => row.remove());
    tbody.appendChild(row);
}

function loadCatalog() {
    sendAjax('quotes', 'getCatalog', {}, function (data) {
        if (!data || !data.message) return;
        catalogItems = data.message;
        const existing = document.getElementById('catalogCodes');
        if (existing && existing.parentNode) {
            existing.parentNode.removeChild(existing);
        }
        const list = document.createElement('datalist');
        list.id = 'catalogCodes';
        catalogItems.forEach(item => {
            const option = document.createElement('option');
            option.value = item.CODE;
            option.label = `${item.NAME} (${item.TYPE})`;
            list.appendChild(option);
        });
        document.body.appendChild(list);

        document.querySelectorAll('#quoteItems tbody tr').forEach(attachItemRowEvents);
    }, true, false, () => showQuoteAlert('No se pudo cargar el catálogo de ítems.', 'alert-danger'));
}

function loadClientOptions() {
    sendAjax('quotes', 'getClientsForQuotes', {}, function (data) {
        const select = document.getElementById('quoteClient');
        if (!select) {
            return;
        }
        if (!data || !data.message) {
            select.innerHTML = '<option value="">Seleccione un cliente</option>';
            return;
        }

        quoteClients = data.message;
        select.innerHTML = '<option value="">Seleccione un cliente</option>';
        quoteClients.forEach(client => {
            const option = document.createElement('option');
            option.value = client.CODE;
            option.textContent = client.CNAME;
            select.appendChild(option);
        });
        syncClientFields();
    }, true, false, () => showQuoteAlert('No se pudieron cargar los clientes.', 'alert-danger'));
}

function loadBranchOptions(clientCode, preselect) {
    sendAjax('quotes', 'getBranchesForClient', {clientCode: clientCode || ''}, function (data) {
        const select = document.getElementById('quoteSucu');
        if (!select) {
            return;
        }

        if (!data || !data.message) {
            select.innerHTML = '<option value="">Seleccione una sucursal</option>';
            syncBranchFields();
            return;
        }

        quoteBranches = data.message;
        select.innerHTML = '<option value="">Seleccione una sucursal</option>';
        quoteBranches.forEach(branch => {
            const option = document.createElement('option');
            option.value = branch.CODE;
            option.textContent = branch.NAME;
            option.dataset.parent = branch.PARENTCODE || '';
            select.appendChild(option);
        });
        if (preselect) {
            ensureOption(select, preselect);
            select.value = preselect;
        }
        syncBranchFields();
    }, true, false, () => showQuoteAlert('No se pudieron cargar las sucursales.', 'alert-danger'));
}

function loadQuotesList() {
    sendAjax('quotes', 'listQuotes', {}, function (data) {
        const quotes = (data && data.message) ? data.message : [];
        renderQuotesList(quotes);
    }, true, false, () => showQuoteAlert('No se pudieron cargar las cotizaciones.', 'alert-danger'));
}

function renderQuotesList(quotes) {
    const tbody = document.querySelector('#quoteList tbody');
    const emptyBox = document.getElementById('quoteListEmpty');
    if (!tbody) {
        return;
    }
    tbody.innerHTML = '';

    if (!quotes || quotes.length === 0) {
        if (emptyBox) {
            emptyBox.style.display = 'block';
        }
        return;
    }

    if (emptyBox) {
        emptyBox.style.display = 'none';
    }

    quotes.forEach(quote => {
        const row = document.createElement('tr');
        row.innerHTML = [
            `<td>${quote.CODE || ''}</td>`,
            `<td>${quote.CLIENTNAME || ''}</td>`,
            `<td>${quote.DATE || ''}</td>`,
            `<td>${quote.STATUS || ''}</td>`,
            `<td>${quote.TOTAL || ''}</td>`
        ].join('');
        row.addEventListener('click', () => loadQuoteDetail(quote.CODE));
        tbody.appendChild(row);
    });
}

function loadQuoteDetail(code) {
    if (!code) {
        return;
    }
    sendAjax('quotes', 'getQuote', {code: code}, function (data) {
        if (!data || !data.message || !data.message.quote) {
            showQuoteAlert('No se encontró la cotización solicitada.', 'alert-warning');
            return;
        }
        populateQuoteDetail(data.message);
    }, true, false, () => showQuoteAlert('No se pudo cargar la cotización seleccionada.', 'alert-danger'));
}

function populateQuoteDetail(detail) {
    resetQuoteForm();
    const quote = detail.quote;

    ensureOption(document.getElementById('quoteClient'), quote.CLIENTCODE, quote.CLIENTNAME);
    ensureOption(document.getElementById('quoteSucu'), quote.SUCUCODE, quote.SUCUNAME);

    document.getElementById('quoteCode').value = quote.CODE || '';
    document.getElementById('quoteClient').value = quote.CLIENTCODE || '';
    document.getElementById('quoteClientName').value = quote.CLIENTNAME || '';
    document.getElementById('quoteSucu').value = quote.SUCUCODE || '';
    document.getElementById('quoteSucuName').value = quote.SUCUNAME || '';
    document.getElementById('quoteContact').value = quote.CONTACT || '';
    document.getElementById('quoteValid').value = quote.VALIDUNTIL || '';
    document.getElementById('quoteCurrency').value = quote.CURRENCY || 'COP';
    document.getElementById('quoteNotes').value = quote.NOTES || '';
    document.getElementById('quoteStatus').textContent = quote.STATUS || 'Borrador';

    loadBranchOptions(quote.CLIENTCODE || '', quote.SUCUCODE || '');
    syncClientFields();
    syncBranchFields();

    const itemsBody = document.querySelector('#quoteItems tbody');
    const costBody = document.querySelector('#internalCosts tbody');
    if (itemsBody) { itemsBody.innerHTML = ''; }
    if (costBody) { costBody.innerHTML = ''; }

    if (Array.isArray(detail.items)) {
        detail.items.forEach(item => {
            addItemRow({
                code: item.ITEM_CODE,
                desc: item.ITEM_DESC,
                type: item.ITEM_TYPE,
                qty: item.QTY,
                unitPrice: item.UNIT_PRICE,
                tax: item.TAX,
                inventoryCode: item.INVENTORY_CODE
            });
        });
    }

    if (Array.isArray(detail.internalCosts)) {
        detail.internalCosts.forEach(cost => {
            addCostRow({
                type: cost.COST_TYPE,
                amount: cost.AMOUNT,
                note: cost.NOTE
            });
        });
    }
}

function collectQuoteInfo() {
    const normalizedUserCode = (typeof getNormalizedUserCode === 'function'
        ? getNormalizedUserCode()
        : (window.aud && window.aud.CODE ? String(window.aud.CODE).toUpperCase() : '')) || 'webuser';

    const items = [];
    document.querySelectorAll('#quoteItems tbody tr').forEach(row => {
        items.push({
            code: row.querySelector('.code').value,
            desc: row.querySelector('.desc').value,
            type: row.querySelector('.type').value,
            qty: row.querySelector('.qty').value || '0',
            unitPrice: row.querySelector('.unitPrice').value || '0',
            tax: row.querySelector('.tax').value || '0',
            inventoryCode: row.querySelector('.inventoryCode').value
        });
    });

    const internalCosts = [];
    document.querySelectorAll('#internalCosts tbody tr').forEach(row => {
        internalCosts.push({
            type: row.querySelector('.costType').value,
            amount: row.querySelector('.costAmount').value || '0',
            note: row.querySelector('.costNote').value
        });
    });

    return {
        code: document.getElementById('quoteCode').value,
        clientCode: document.getElementById('quoteClient').value,
        clientName: document.getElementById('quoteClientName').value,
        sucuCode: document.getElementById('quoteSucu').value,
        sucuName: document.getElementById('quoteSucuName').value,
        contact: document.getElementById('quoteContact').value,
        validUntil: document.getElementById('quoteValid').value,
        currency: document.getElementById('quoteCurrency').value,
        notes: document.getElementById('quoteNotes').value,
        items: items,
        internalCosts: internalCosts,
        status: document.getElementById('quoteStatus').textContent,
        autor: 'webuser',
        autorCode: normalizedUserCode,
        date: new Date().toISOString().slice(0, 19).replace('T', ' ')
    };
}

function saveQuote() {
    const info = collectQuoteInfo();
    const method = info.code ? 'updateQuote' : 'createQuote';
    sendQuoteRequest(method, info, function (resp) {
        if (resp && resp.message) {
            document.getElementById('quoteCode').value = resp.message.code;
            document.getElementById('quoteStatus').textContent = resp.message.status;
        }
        showQuoteAlert('Cotización guardada correctamente', 'alert-success');
        loadQuotesList();
    });
}

function changeStatus(method) {
    const info = collectQuoteInfo();
    if (!info.code) {
        showQuoteAlert('Primero guarda la cotización para obtener un código.', 'alert-warning');
        return;
    }
    info.comment = document.getElementById('statusComment').value;
    sendQuoteRequest(method, info, function (resp) {
        if (resp && resp.message) {
            document.getElementById('quoteStatus').textContent = resp.message.status;
        }
        if (resp && resp.message && resp.message.orderCode) {
            showQuoteAlert('Cotización aprobada y OT creada: ' + resp.message.orderCode, 'alert-success');
        } else {
            showQuoteAlert('Estado actualizado', 'alert-info');
        }
        loadQuotesList();
    });
}

function sendQuoteRequest(method, data, cb) {
    sendAjax('quotes', method, data, function (payload) {
        if (payload) {
            cb(payload);
        } else {
            showQuoteAlert('No se pudo procesar la respuesta del servidor.', 'alert-danger');
        }
    }, false, false, () => showQuoteAlert('Error al comunicarse con el servidor.', 'alert-danger'));
}

function showQuoteAlert(msg, cssClass) {
    const box = document.getElementById('quoteAlert');
    box.className = 'alert ' + cssClass;
    box.textContent = msg;
    box.style.display = 'block';
}
