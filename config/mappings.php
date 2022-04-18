<?php

return [
    'Sds\Domain\Models\User' => [
        'type' => 'entity',
        'table' => 'users',
        'id' => [
            'id' => [
                'type' => 'integer',
                'generator' > [
                    'strategy' => 'auto'
                ]
            ]
        ],

        'fields' => [
            'username' => [
                'type' => 'string'
            ],
            'password' => [
                'type' => 'string'
            ]
        ]
    ]
];
