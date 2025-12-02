<?php
return [
    'role_permissions' => [
        'A' => ['*'],
        'CO' => [
            'inventory.view',
            'inventory.manage',
            'purchases.manage',
            'costs.manage',
            'internalSheets.view',
            'internalSheets.manage',
        ],
        'JZ' => [
            'inventory.view',
            'costs.manage',
            'internalSheets.view',
        ],
        'T' => [
            'internalSheets.view',
        ],
        'C' => [
            'inventory.view',
        ],
    ],
    'method_permissions' => [
        'users' => [
            'getInveList' => 'inventory.view',
            'inveSave' => 'inventory.manage',
            'addInvQty' => 'inventory.manage',
            'discountInv' => 'inventory.manage',
            'saveoPart' => 'costs.manage',
            'saveoOther' => 'costs.manage',
            'saveoOtherLeg' => 'costs.manage',
            'updateActCost' => 'costs.manage',
            'updatePartCost' => 'costs.manage',
            'updateOtherCost' => 'costs.manage',
            'getOtotals' => 'costs.manage',
            'orderSave' => 'costs.manage',
            'reportCreate' => 'costs.manage',
            'reportCreateTotalized' => 'costs.manage',
            'generateRecepit' => 'purchases.manage',
            'nullifyReceipt' => 'purchases.manage',
            'redateReceipt' => 'purchases.manage',
            'setResolution' => 'purchases.manage',
            'getLeg' => 'internalSheets.view',
            'getUserLegs' => 'internalSheets.view',
            'refreshLegCodes' => 'internalSheets.manage',
            'restoreLeg' => 'internalSheets.manage',
        ],
        'inventory' => [
            'listItems' => 'inventory.view',
            'saveItem' => 'inventory.manage',
            'registerEntry' => 'inventory.manage',
            'registerExit' => 'inventory.manage',
            'listMovements' => 'inventory.view',
        ],
    ],
];
