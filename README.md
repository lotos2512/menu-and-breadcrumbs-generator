Menu and breadcrumbs generator
============================

Generate HTML menu and breadcrumbs from php array
  
[![Latest Stable Version](https://poser.pugx.org/lotos2512/menu-and-breadcrumbs-generator/v/stable)](https://packagist.org/packages/lotos2512/menu-and-breadcrumbs-generator)
[![Total Downloads](https://poser.pugx.org/lotos2512/menu-and-breadcrumbs-generator/downloads)](https://packagist.org/packages/lotos2512/menu-and-breadcrumbs-generator)
[![Latest Unstable Version](https://poser.pugx.org/lotos2512/menu-and-breadcrumbs-generator/v/unstable)](https://packagist.org/packages/lotos2512/menu-and-breadcrumbs-generator)
[![License](https://poser.pugx.org/lotos2512/menu-and-breadcrumbs-generator/license)](https://packagist.org/packages/lotos2512/menu-and-breadcrumbs-generator)
[![Build Status](https://travis-ci.org/lotos2512/menu-and-breadcrumbs-generator.svg?branch=master)](https://travis-ci.org/lotos2512/menu-and-breadcrumbs-generator)
[![Coverage Status](https://codecov.io/gh/lotos2512/menu-and-breadcrumbs-generator/badge.svg)](https://codecov.io/gh/lotos2512/menu-and-breadcrumbs-generator)


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run
```
 php composer.phar require lotos2512/menu-and-breadcrumbs-generator
 
```
Example  

https://github.com/lotos2512/menu-and-breadcrumbs-generator/blob/master/example/index.php

## Base usage for menu
```php
// Create array like this 

$tree = [
    /**
     * СООБЩЕНИЯ
     */
    'personal_messages.php' => [
        'name' => function () {
            return 'Сообщений 10/10';
        },
        'children' => [
            'test' => [
                'name' => 'тest - ',
                'url' => '/admin/test',
                'permission' => true,
                'params' => ['package_id'],
                'namePostFix' => 'package_id',
            ],
            'test2' => [
                'name' => 'тest',
                'url' => '/admin/test2',
                'visible' => 'onPage'
            ],
            
        ]
    ],
];

$menu = (new MenuGenerator('/admin/test2', $tree))->getMenu();
```
Definitions keys: 

name - Name of node, accept sting or callback (required).

url - Url of node.Accept string value.

permission - Use for permission of node.Accept bool value or callback. 

params - array with string values, what will be add param form $_GET to url if the node url is current.

namePostFix - string value, what will get value from $_GET and add to name of the node if url is current.

children - array with nodes.

visible - string value Node::VISIBLE_TYPE_CURRENT_PAGE, use to show the node if url is current. 

Base usage for breadcrumbs 

```php

$breadcrumbs = (new BreadcrumbsGenerator(new RecursiveBreadcrumbsStrategy(), '/admin/update_transaction.php', $tree))->getBreadcrumbs();
$breadcrumbs = (new BreadcrumbsGenerator(new PrettyUrlBreadcrumbsStrategy(), '/admin/update_transaction.php', $tree))->getBreadcrumbs();

// use RecursiveBreadCrumbsStrategy to create $breadcrumbs for the node, even if the tree is wrong like $tree.

```
use PrettyUrlBreadcrumbsStrategy to create $breadcrumbs for the node if $tree is true.
For example you want find breadcrumbs for url - '/cryptography/certificates/view/?id=1'
your tree must be like this
```php
[
    'cryptography' => [
        'permission' => function () {
            return true;
        },
        'name' =>'Криптография',
        'children' => [
            'certificates' => [
                'name' =>'Сертификаты',
                'url' => '/cryptography/certificates',
                'children' => [
                   'name' =>'Сертификат',
                   'url' => '/cryptography/certificates/view/',
                   'visible' => Node::VISIBLE_TYPE_CURRENT_PAGE,
                ]
            ],
            'create-request' => [
                'name' =>'Запрос сертификата',
                'url' => '/cryptography/create-request',
            ],
            'upload-signed-certificates' => [
                'name' =>'Загрузка подписанных сертификатов',
                'url' => '/cryptography/upload-signed-certificates',
            ]
        ],
    ],
]
```
Custom node HTML for menu 

```php
/**
 * Class YouMenuGenerator
 */
YourMenuGenerator extends MenuGenerator
{
    /**
    * @see MenuGenerator::getHtmlBlock
    */
    protected function getHtmlBlockParams(Node $node, int $level): array
    {
        return [
            'tdClass' => $node->quailsUrl($this->url) === true ? ' class ="select"' : ' ',
            'menuClass' => "menu$level",
            'url' => $node->getUrlWithParams($this->url),
            'name' => $node->getNameWithPostFix($this->url),
        ];
    }
    protected function htmlTemplate(): string
    {
        return
            '<tr>
                <td tdClass>
                    <div class="menuClass">
                    <a href="url">name</a>
                    </div>
                </td>
            </tr>';
    }
}
```
