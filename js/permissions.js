// js/permissions.js

(function (global) {
// Qué puede hacer cada rol (A = admin, CO = coordinador, JZ = jefe zona, T = técnico, C = cliente)
const ROLE_PERMISSIONS = global.ROLE_PERMISSIONS || {
    A: ['*'],
    CO: [
        'inventory.view',
        'inventory.create',
        'inventory.edit',
        'inventory.movement',
        'inventory.adjustment',
        'inventory.manage',
        'orders.view',
        'purchases.orders',
        'costSheets.manage',
        'internalSheets.view',
        'internalSheets.manage',
        'reports.export',
        'quotes.manage'
    ],
    JZ: [
        'inventory.view',
        'inventory.manage',
        'orders.view',
        'costSheets.manage',
        'internalSheets.view',
        'reports.export',
        'quotes.manage'
    ],
    CP: [
        'purchases.orders',
        'inventory.view',
        'orders.view'
    ],
    T: [
        'internalSheets.view',
        'orders.view'
    ],
    C: [
        'orders.view'
    ]
};

// Mapea métodos del backend -> permisos lógicos
const METHOD_PERMISSION_MAP = global.METHOD_PERMISSION_MAP || {
    users: {
        getInveList: 'inventory.view',
        inveSave: ['inventory.create', 'inventory.edit', 'inventory.manage'],
        addInvQty: ['inventory.movement', 'inventory.manage'],
        discountInv: ['inventory.movement', 'inventory.adjustment', 'inventory.manage'],

        getParentSucus: 'orders.view',
        getOrdeList: 'orders.view',

        saveoPart: 'costSheets.manage',
        saveoOther: 'costSheets.manage',
        saveoOtherLeg: 'costSheets.manage',
        updateActCost: 'costSheets.manage',
        updatePartCost: 'costSheets.manage',
        updateOtherCost: 'costSheets.manage',
        getOtotals: 'costSheets.manage',
        orderSave: 'costSheets.manage',
        reportCreate: 'costSheets.manage',
        reportCreateTotalized: 'costSheets.manage',

        generateRecepit: 'purchases.orders',
        nullifyReceipt: 'purchases.orders',
        redateReceipt: 'purchases.orders',
        setResolution: 'purchases.orders',

        getLeg: 'internalSheets.view',
        getUserLegs: 'internalSheets.view',
        refreshLegCodes: 'internalSheets.manage',
        restoreLeg: 'internalSheets.manage',

        exportCVS: 'reports.export'
        ,
        importActivitiesFromExcel: 'costSheets.manage'
    },

    inventory: {
        listItems: 'inventory.view',
        // crear / editar ítem
        saveItem: ['inventory.create', 'inventory.edit', 'inventory.manage'],
        // movimientos de entrada / salida
        registerEntry: ['inventory.movement', 'inventory.manage'],
        registerExit: ['inventory.movement', 'inventory.adjustment', 'inventory.manage'],
        // conteo físico
        recordPhysicalCount: 'inventory.manage',
        applyPhysicalAdjustment: ['inventory.adjustment', 'inventory.manage'],
        // consultas / export
        listMovements: 'inventory.view',
        exportInventory: 'inventory.view',
        importInventoryFile: 'inventory.manage',
        importItemsFromExcel: 'inventory.manage',
        importStockFromExcel: 'inventory.manage'
    },

    purchases: {
        createSupplier: 'purchases.orders',
        updateSupplier: 'purchases.orders',
        listSuppliers: 'purchases.orders',
        createPoFromRq: 'purchases.orders',
        updateNegotiatedCosts: 'purchases.orders',
        listPurchaseOrders: 'purchases.orders',
        receivePurchase: 'purchases.orders'
    },
    quotes: {
        createQuote: 'quotes.manage',
        updateQuote: 'quotes.manage',
        sendQuote: 'quotes.manage',
        approveQuote: 'quotes.manage',
        rejectQuote: 'quotes.manage',
        getCatalog: 'quotes.manage',
        getClientsForQuotes: 'quotes.manage',
        getBranchesForClient: 'quotes.manage',
        listQuotes: 'quotes.manage',
        getQuote: 'quotes.manage'
    }
};

// Qué controles del DOM se protegen con cada permiso
const ACTION_PERMISSION_MAP = global.ACTION_PERMISSION_MAP || {
    'inventory.create': [
        '#inveSaveButton'
    ],
    'inventory.edit': [
        '#inveSaveButton',
        '#inventoryEntryBtn',
        '#inventoryExitBtn'
    ],
    'inventory.movement': [
        '#addInvQty',
        '#inventoryEntryBtn',
        '#inventoryExitBtn',
        '#inventoryCountBtn',
        '#inventoryAdjustBtn'
    ],
    'inventory.adjustment': [
        '#inventoryExitBtn'
    ],
    'inventory.view': [
        '#inventoryExportBtn'
    ],
    'inventory.manage': [
        '#inveSaveButton',
        '#inventoryEntryBtn',
        '#inventoryExitBtn',
        '#addInvQty',
        '#inventoryImportBtn'
    ],
    'costSheets.manage': [
        '#orderSaveButton',
        '#orderSaveButtonCL',
        '#addActButton',
        '#addPartButton',
        '#addOtherButton'
    ],
    'purchases.orders': [
        '#upButtonBudget',
        '#a-resoNumber',
        '#a-resoDate'
    ],
    'reports.export': [
        '#exportCsvButton',
        '#exportReportButton'
    ],
    'internalSheets.manage': [
        '#legSaveButton',
        '#legCloseButton'
    ]
};

function hasPermission(role, permission) {
    const allowed = ROLE_PERMISSIONS[role] || [];
    return allowed.includes('*') || allowed.includes(permission);
}

function canCallProtectedMethod(targetClass, method, role) {
    // login siempre permitido
    if (method === 'login') {
        return true;
    }

    const permission = (METHOD_PERMISSION_MAP[targetClass] || {})[method];

    // Si el método no está en el mapa, lo dejamos pasar (comportamiento legacy)
    if (!permission) {
        return true;
    }

    if (Array.isArray(permission)) {
        return permission.some(candidate => hasPermission(role, candidate));
    }

    return hasPermission(role, permission);
}

function disableControl(control, permission) {
    if (control.tagName === 'BUTTON' || control.tagName === 'INPUT') {
        control.disabled = true;
    }
    control.classList.add('permission-locked');
    control.setAttribute('title', 'Acción restringida: ' + permission);
    if (control.style) {
        control.style.opacity = 0.6;
        control.style.pointerEvents = 'none';
    }
}

function applyPermissionGuards(role) {
    Object.entries(ACTION_PERMISSION_MAP).forEach(([permission, selectors]) => {
        const permitted = hasPermission(role, permission);
        selectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(element => {
                if (!permitted) {
                    disableControl(element, permission);
                }
            });
        });
    });

    // hook opcional para ocultar precios a técnicos
    if (typeof hidePricesForTechnicians === 'function' && role === 'T') {
        hidePricesForTechnicians();
    }
}

function getStoredUserContext() {
    if (typeof localStorage === 'undefined') {
        return null;
    }

    try {
        const storedContext = localStorage.getItem('userContext');
            if (storedContext) {
                const parsed = JSON.parse(storedContext);
                return {
                    code: parsed.code ?? parsed.CODE,
                    role: parsed.role ?? parsed.TYPE,
                    email: parsed.email ?? parsed.MAIL ?? parsed.mail,
                    name: parsed.name ?? parsed.RESPNAME,
                    client_code: parsed.client_code ?? parsed.CLIENT_CODE
                };
            }

        const aud = localStorage.getItem('aud');
        if (!aud) {
            return null;
        }

        const parsed = JSON.parse(aud);
        return {
            code: parsed.CODE,
            role: parsed.TYPE,
            email: parsed.MAIL || parsed.mail,
            name: parsed.RESPNAME,
            client_code: parsed.CLIENT_CODE
        };
    } catch (e) {
        return null;
    }
}

(global.ROLE_PERMISSIONS = ROLE_PERMISSIONS);
(global.METHOD_PERMISSION_MAP = METHOD_PERMISSION_MAP);
(global.ACTION_PERMISSION_MAP = ACTION_PERMISSION_MAP);

// Exponer en window para que main.js los use
global.hasPermission = hasPermission;
global.canCallProtectedMethod = canCallProtectedMethod;
global.applyPermissionGuards = applyPermissionGuards;
global.getStoredUserContext = getStoredUserContext;

})(window);
