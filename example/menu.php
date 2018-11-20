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

    /**
     * ФРОД МОНИТОРИНГ
     */
    'frod_monitoring' => [
        'name' =>'Фрод мониторинг',
        'permission' => true,
        'children' => [
            'fraud_monitoring.php' => [
                'url' => "/admin/fraud_monitoring.php",
                'name' =>'Транзакции',
                'children' => [
                    'filter_process.php' => [
                        'visible' => 'onPage',
                        'url' => "/admin/filter_process.php",
                        'namePostFix' => 'object_id',
                        'params' => ['object_id'],
                        'name' =>'Фильтр по',
                    ],
                ],
            ],
            'fraud_monitoring_conversion.php' => [
                'url' => "/admin/fraud_monitoring_conversion.php",
                'name' =>'Конверсия',
            ],
            'geo_bank_country_transactions.php' => [
                'url' => "/admin/geo_bank_country_transactions.php",
                'name' =>'Гео данные по картам',
            ],
            'assigned_filters.php' => [
                'url' => "/admin/assigned_filters.php",
                'name' =>'Назначить фильтр',
                'permission' => true,
                'children' => [
                    'assign_filter.php' => [
                        'visible' => 'onPage',
                        'url' => "/admin/assign_filter.php",
                        'name' =>'Присвоить фильтр {{merchant_name}}',
                        'params' => ['action', 'merchant_id'],
                    ],
                    'filters.php' => [
                        'url' => "/admin/filters.php",
                        'name' =>'Фильтры',
                        'children' => [
                            'edit_filter' => [
                                'visible' => 'onPage',
                                'url' => "/admin/edit_filter.php",
                                'name' =>'Фильтр {{name}}',
                                'params' => ['action', 'filter_id'],
                            ],
                        ],
                    ],
                    'conditions.php' => [
                        'url' => "/admin/conditions.php",
                        'name' =>'Условия',
                        'permission' => true,
                        'children' => [
                            'edit_condition.php' => [
                                'url' => "/admin/edit_condition.php",
                                'name' =>'Условие {{name}}',
                                'visible' => 'onPage',
                                'params' => ['action', 'condition_id', 'setting_id'],
                            ]
                        ]
                    ],
                ],
            ],
            'hash_card_pan.php' => [
                'name' =>'Инструменты',
                'permission' => false,
                'children' => [
                    [
                        'url' => "/admin/hash_card_pan.php",
                        'name' =>'Хеширование номеров карт',
                    ]
                ]
            ],
            'bin_database.php' => [
                'permission' => true,
                'url' => "/admin/bin_database.php",
                'name' =>'База данных бинов',
                'children' => [
                    'namePostFixd_bin_database.php' => [
                        'url' => "/admin/namePostFixd_bin_database.php",
                        'name' =>'Подмены бинов',
                        'children' => [
                            'edit_bin_namePostFix.php' => [
                                'url' => "/admin/edit_bin_namePostFix.php",
                                'name' =>'Подмена бина',
                                'params' => [
                                    'bin', 'card_brand', 'card_type', 'card_category',
                                    'bank_name', 'bank_country', 'bank_country', 'bank_contact_data'
                                ],
                                'namePostFix' => 'bin',
                            ]
                        ]
                    ],
                    'create_bin_namePostFix.php' => [
                        'url' => "/admin/create_bin_namePostFix.php",
                        'name' =>'Создать подмену',
                    ]
                ],
            ]
        ],
    ],

    /**
     * НАСТРОЙКИ
     */
    'settings' => [
        'name' =>'Настройки',
        'children' => [
            'employee.php' => [
                'url' => "/admin/employee.php",
                'name' =>'Сотрудник',
            ],
            'merchants.php' => [
                'permission' => true,
                'url' => "/admin/merchants.php",
                'name' =>'Магазины',
                'children' => [
                    'merchant.php' => [
                        'visible' => 'onPage',
                        'url' => '/admin/merchant.php',
                        'name' =>'Магазин #{{merchant_id}}',
                    ],
                    'merchant_handle_settings.php' => [
                        'visible' => 'onPage',
                        'url' => "/admin/merchant_handle_settings.php",
                        'name' =>'Изменение настроек магазина',
                        'namePostFix' => 'merchant_id',
                        'params' => ['merchant_id', 'action'],
                    ]
                ]
            ],
            'legal_entities.php' => [
                'url' => "/control/legal_entities.php",
                'name' =>'Юр.лицо',
            ],
            'dep.php' => [
                'url' => "/control/dep.php",
                'name' =>'Мои сотрудники',
                'permission' => false,
            ],
            'bank_accounts.php' => [
                'url' => "/control/bank_accounts.php",
                'name' =>'Банковские счета',
            ],
            'email_templates_merchant.php' => [
                'url' => "/admin/email_templates_merchant.php",
                'name' =>'Шаблоны Email мерчанта',
                'children' => [
                    'edit_email_templates_merchant.php' => [
                        'url' => "/admin/edit_email_templates_merchant.php",
                        'name' =>'Редактирование Email шаблона {{template_name}}',
                        'visible' => 'onPage',
                    ],
                ],
            ],
            'email_templates_customer.php' => [
                'url' => "/admin/email_templates_customer.php",
                'name' =>'Шаблоны Email клиента',
                'children' => [
                    'edit_email_templates_customer.php' => [
                        'url' => "/admin/edit_email_templates_customer.php",
                        'name' =>'Редактирование Email шаблона {{template_name}}',
                        'visible' => 'onPage',
                    ]
                ]
            ],
            'edit_sms_templates_customer.php' => [
                'url' => "/admin/sms_templates_customer.php",
                'name' =>'Шаблоны SMS клиента',
                'children' => [
                    'edit_sms_templates_customer.php' => [
                        'url' => "/admin/edit_sms_templates_customer.php",
                        'name' =>'Редактирование СМС шаблона {{template_name}}',
                        'visible' => 'onPage',
                    ]
                ]
            ],
        ],

    ],
    /**
     * Доп.услуги
     */
    'advanced-services' => [
        'name' =>'Доп.услуги',
        'children' => [
            'statistics_sms_notif.php' => [
                'permission' => true,
                'url' => "/admin/statistics_sms_notif.php",
                'name' =>'Услуга SMS-оповещений',
            ],
            'sms_credit_sale.php' => [
                'url' => "/admin/sms_credit_sale.php",
                'name' =>'Покупка SMS-кредитов',
                'permission' => true,
            ],
            'sms_credit_sale_transaction.php' => [
                'permission' => true,
                'url' => "/admin/sms_credit_sale_transaction.php",
                'name' =>'sms_credit_sale_transaction',
            ],
            'sms_view.php' => [
                'permission' => true,
                'url' => "/admin/sms_view.php",
                'name' =>'Просмотр SMS-сообщений',
            ],
        ],
    ],

    /**
     * ЮРИДИЧЕСКИЕ ДОКУМЕНТЫ
     */
    'documents.php' => [
        'url' => "/admin/documents.php",
        'name' =>'Юридические документы',
        'permission' => true,
        'children' => [
            'offer.php' => [
                'url' => '/admin/offer.php',
                'name' =>'Оферта',
                'visible' => 'onPage',
                'namePostFix' => 'contract_id',
                'params' => ['contract_id'],
            ],
            'saved_offer.php' => [
                'url' => '/admin/saved_offer.php',
                'name' =>'Договора',
            ],
        ],
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

];
