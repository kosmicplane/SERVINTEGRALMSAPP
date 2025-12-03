const ROLE_PERMISSIONS = {
    A: ['*'],
    CO: [
        'inventory.view',
        'inventory.create',
        'inventory.edit',
        'inventory.movement',
        'inventory.adjustment',
        'inventory.manage',
        'purchases.orders',
        'costSheets.manage',
        'internalSheets.view',
        'internalSheets.manage',
        'reports.export'
    ],
    JZ: [
        'inventory.view',
        'inventory.manage',
        'costSheets.manage',
        'internalSheets.view',
        'reports.export'
    ],
    T: [
        'internalSheets.view'
    ],
    C: [
        'inventory.view'
    ]
};

const METHOD_PERMISSION_MAP = {
    users: {
        getInveList: 'inventory.view',
        inveSave: ['inventory.create', 'inventory.edit', 'inventory.manage'],
        addInvQty: ['inventory.movement', 'inventory.manage'],
        discountInv: ['inventory.movement', 'inventory.adjustment', 'inventory.manage'],
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
    },
        inventory: {
        listItems: 'inventory.view',
        saveItem: ['inventory.create', 'inventory.edit', 'inventory.manage'],
        registerEntry: ['inventory.movement', 'inventory.manage'],
        registerExit: ['inventory.movement', 'inventory.adjustment', 'inventory.manage'],
        recordPhysicalCount: 'inventory.manage',
        applyPhysicalAdjustment: 'inventory.manage',
        listMovements: 'inventory.view',
        exportInventory: 'inventory.view'
    },
    purchases: {
        createSupplier: 'purchases.orders',
        listSuppliers: 'purchases.orders',
        createPoFromRq: 'purchases.orders',
        updateNegotiatedCosts: 'purchases.orders',
        listPurchaseOrders: 'purchases.orders',
        receivePurchase: 'purchases.orders'
    }
};

const ACTION_PERMISSION_MAP = {
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
        '#addInvQty'
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
    if (method === 'login') {
        return true;
    }

    const permission = (METHOD_PERMISSION_MAP[targetClass] || {})[method];

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

    if (typeof hidePricesForTechnicians === 'function' && role === 'T') {
        hidePricesForTechnicians();
    }
}

function getStoredUserContext() {
    if (typeof localStorage === 'undefined') {
        return null;
    }

    try {
        const aud = localStorage.getItem('aud');
        if (!aud) {
            return null;
        }
        const parsed = JSON.parse(aud);
        return {
            code: parsed.CODE,
            role: parsed.TYPE,
            email: parsed.MAIL || parsed.mail,
            name: parsed.RESPNAME
        };
    } catch (e) {
        return null;
    }
}

window.hasPermission = hasPermission;
window.canCallProtectedMethod = canCallProtectedMethod;
window.applyPermissionGuards = applyPermissionGuards;
window.getStoredUserContext = getStoredUserContext;
