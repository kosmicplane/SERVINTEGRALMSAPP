const ROLE_PERMISSIONS = {
    A: ['*'],
    CO: [
        'inventory.view',
        'inventory.manage',
        'purchases.manage',
        'costs.manage',
        'internalSheets.view',
        'internalSheets.manage'
    ],
    JZ: [
        'inventory.view',
        'costs.manage',
        'internalSheets.view'
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
        inveSave: 'inventory.manage',
        addInvQty: 'inventory.manage',
        discountInv: 'inventory.manage',
        saveoPart: 'costs.manage',
        saveoOther: 'costs.manage',
        saveoOtherLeg: 'costs.manage',
        updateActCost: 'costs.manage',
        updatePartCost: 'costs.manage',
        updateOtherCost: 'costs.manage',
        getOtotals: 'costs.manage',
        orderSave: 'costs.manage',
        reportCreate: 'costs.manage',
        reportCreateTotalized: 'costs.manage',
        generateRecepit: 'purchases.manage',
        nullifyReceipt: 'purchases.manage',
        redateReceipt: 'purchases.manage',
        setResolution: 'purchases.manage',
        getLeg: 'internalSheets.view',
        getUserLegs: 'internalSheets.view',
        refreshLegCodes: 'internalSheets.manage',
        restoreLeg: 'internalSheets.manage'
    },
    inventory: {
        listItems: 'inventory.view',
        saveItem: 'inventory.manage',
        registerEntry: 'inventory.manage',
        registerExit: 'inventory.manage',
        recordPhysicalCount: 'inventory.manage',
        applyPhysicalAdjustment: 'inventory.manage',
        listMovements: 'inventory.view'
    }
};

const ACTION_PERMISSION_MAP = {
    'inventory.manage': [
        '#inveSaveButton',
        '#addInvQty',
        '#inventoryEntryBtn',
        '#inventoryExitBtn',
        '#inventoryCountBtn',
        '#inventoryAdjustBtn'
    ],
    'costs.manage': [
        '#orderSaveButton',
        '#orderSaveButtonCL',
        '#addActButton',
        '#addPartButton',
        '#addOtherButton'
    ],
    'purchases.manage': [
        '#upButtonBudget',
        '#a-resoNumber',
        '#a-resoDate'
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
