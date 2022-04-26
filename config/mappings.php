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

        'embedded' => [
            'user' => [
                'class' => 'Sds\Domain\ValueObjects\PlayerName',
                'columnPrefix' => false,
            ]
        ],

        'fields' => [
            'password' => [
                'type' => 'string'
            ],

            'gender' => [
                'type' => 'string',
            ]
        ]
    ],

    'Sds\Domain\ValueObjects\PlayerName' => [
        'type' => 'embeddable',
        'fields' => [
            'username' => [
                'type' => 'string',
            ]
        ]
    ]
];
