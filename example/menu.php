<?php

return [

    /**
     * СООБЩЕНИЯ
     */
    'personal_messages.php' => [
        'name' => function () {
            return 'Сообщений 10/10';
        }
    ],
    /**
     * ПЛАТЕЖИ
     */
    'admin' => [
        'url' => '/admin/',
        'name' => 'Платежи',
        'children' => [
            'test' => [
                'url' => '/blocks/main/',
                'name' => 'Тест от Андрея',
                'visible' => 'onPage',
                'params' => ['a'],
            ],
            /**
             * ИНСТРУКЦИИ
             */
            'instructions.php' => [
                'url' => '/admin/instructions.php',
                'name' =>'Инструкции',
            ],
            /**
             * Криптография
             */
            'cryptography' => [
                'permission' => function () {
                    return true;
                },
                'name' =>'Криптография',
                'children' => [
                    'certificates' => [
                        'name' =>'Сертификаты',
                        'url' => '/admin/cryptography/certificates',
                    ],
                    'create-request' => [
                        'name' =>'Запрос сертификата',
                        'url' => '/admin/cryptography/create-request',
                    ],
                    'upload-signed-certificates' => [
                        'name' =>'Загрузка подписанных сертификатов',
                        'url' => '/admin/cryptography/upload-signed-certificates',
                    ]
                ],
            ],
            'transactions.php' => [
                'name' => 'Транзакции',
                'url' => '/admin/transactions.php',
                'children' => [
                    'transaction.php' => [
                        'url' => '/admin/transaction.php',
                        'name' => 'Транзакция',
                        'namePostFix' => 'object_id',
                        'params' => ['object_id'],
                        'visible' => 'onPage',
                    ],
                    'update_transaction.php' => [
                        'url' => "/admin/update_transaction.php",
                        'visible' => 'onPage',
                        'name' => 'Редактирование Транзакции',
                        'namePostFix' => 'object_id',
                        'params' => ['object_id'],
                    ],
                ]
            ],
            'refunds.php' => [
                'name' => 'Возвраты',
                'permission' => true,
                'url' => "/admin/refunds.php",
                'children' => [
                    'refund.php' => [
                        'visible' => 'onPage',
                        'url' => '/admin/refund.php',
                        'name' => 'Транзакция',
                        'namePostFix' => 'object_id',
                        'params' => ['object_id'],
                    ]
                ]
            ],
            'moneyback_transactions.php' => [
                'url' => "/admin/moneyback_transactions.php",
                'name' => 'Выплаты покупателям',
                'children' => [
                    'moneyback_transaction.php' => [
                        'url' => "/admin/moneyback_transaction.php",
                        'visible' => 'onPage',
                        'namePostFix' => 'package_id',
                        'name' => 'Транзакция',
                        'params' => ['package_id'],
                    ],
                    'create_moneyback.php' => [
                        'url' => "/admin/create_moneyback.php",
                        'name' => 'Выставить выплату',
                    ],
                ],
            ],
            'transaction_operation_demands.php' => [
                'permission' => true,
                'url' => '/admin/transaction_operation_demands.php',
                'name' =>'Заявки на возврат',
            ],
            'hand_bill_transactions.php' => [
                'permission' => true,
                'url' => "/admin/hand_bill_transactions.php",
                'name' =>'Ручные счета',
                'children' => [
                    'hand_bill_transaction.php' => [
                        'name' =>'Ручной счёт',
                        'url' => "/admin/hand_bill_transaction.php",
                        'visible' => 'onPage',
                        'namePostFix' => 'object_id',
                        'params' => ['object_id'],
                    ],
                    'hand_bill_new.php' => [
                        'permission' => true,
                        'url' => "/admin/hand_bill_new.php",
                        'name' =>'Выставить счёт',
                    ],
                    'payment-message' => [
                        'url' => '/admin/payment-message/list',
                        'name' =>'Сообщения',
                        'children' => [
                            'view' => [
                                'visible' => 'onPage',
                                'url' => '/admin/payment-message/view',
                                'name' =>'Сообщение',
                                'namePostFix' => 'id',
                                'params' => ['id'],
                            ],
                            'create' => [
                                'visible' => 'onPage',
                                'url' => '/admin/payment-message/create',
                                'name' =>'Создание',
                                'namePostFix' => 'id',
                                'params' => ['transactionId'],
                            ]
                        ]
                    ]
                ],
            ]
        ]
    ],
];
