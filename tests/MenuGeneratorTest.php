<?php

namespace lotos2512\menuAndBreadcrumbsGenerator\tests;

/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 20.11.18
 * Time: 20:36
 */

use lotos2512\menuAndBreadcrumbsGenerator\MenuGenerator;
use lotos2512\menuAndBreadcrumbsGenerator\Node;
use lotos2512\menuAndBreadcrumbsGenerator\NodeException;
use PHPUnit\Framework\TestCase;

class MenuGeneratorTest extends TestCase
{
    public function testErrorNodeAttributeNotExists()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'url' => '/admin/test-permission',
                        'children' => [
                            'tab1' => [
                                'name' => 'tab1',
                                'urlError' => '/admin/test-permission/tab1/',
                            ]
                        ]
                    ],
                ]
            ]
        ];
        $this->expectException(NodeException::class);
        $menu = (new MenuGenerator('/admin/test-permission/tab1/', $tree))->getMenu();
    }

    public function testErrorNodeRequiredAttributeNameNotExists()
    {
        $tree = [
            'admin' => [
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'url' => '/admin/test-permission',
                        'children' => [
                            'tab1' => [
                                'name' => 'tab1',
                                'urlError' => '/admin/test-permission/tab1/',
                            ]
                        ]
                    ],
                ]
            ]
        ];
        $this->expectException(NodeException::class);
        (new MenuGenerator('/admin/test-permission/tab1/', $tree))->getMenu();
    }

    public function testAvailablePermissionTab()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'permission' => function () {
                            return true;
                        },
                        'url' => '/admin/test-permission'
                    ],
                ]
            ]
        ];
        $result = '<tr>
                <td >
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr><tr>
                <td >
                    <div class="menu1">
                    <a href="/admin/test-permission">Test-permission</a>
                    </div>
                </td>
            </tr>';

        $menu = (new MenuGenerator('/admin/test-permission/1', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }

    public function testNotAvailablePermissionTab()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'permission' => false,
                        'url' => '/admin/test-permission'
                    ],
                ]
            ]
        ];
        $result = '<tr>
                <td >
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr>';

        $menu = (new MenuGenerator('/admin/test-permission', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }


    public function testNotAvailablePermissionTabWithCallback()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'permission' => function () {
                            return false;
                        },
                        'url' => '/admin/test-permission'
                    ],
                ]
            ]
        ];
        $result = '<tr>
                <td >
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr>';

        $menu = (new MenuGenerator('/admin/test-permission', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }

    public function testSelectTab()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'url' => '/admin/test-permission',
                        'children' => [
                            'tab1' => [
                                'name' => 'tab1',
                                'url' => '/admin/test-permission/tab1/',
                            ]
                        ]
                    ],
                ]
            ]
        ];
        $result = '<tr>
                <td >
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr><tr>
                <td >
                    <div class="menu1">
                    <a href="/admin/test-permission">Test-permission</a>
                    </div>
                </td>
            </tr><tr>
                <td class ="select">
                    <div class="menu2">
                    <a href="/admin/test-permission/tab1/">tab1</a>
                    </div>
                </td>
            </tr>';
        $menu = (new MenuGenerator('/admin/test-permission/tab1/', $tree))->getMenu();
        $this->assertEquals($result, $menu);

    }

    public function testVisibleOnPageHide()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'url' => '/admin/test-permission',
                        'children' => [
                            'tab1' => [
                                'name' => 'tab1',
                                'url' => '/admin/test-permission/tab1/',
                                'visible' => Node::VISIBLE_TYPE_CURRENT_PAGE
                            ]
                        ]
                    ],
                ]
            ]
        ];
        $result = '<tr>
                <td >
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr><tr>
                <td class ="select">
                    <div class="menu1">
                    <a href="/admin/test-permission">Test-permission</a>
                    </div>
                </td>
            </tr>';
        $menu = (new MenuGenerator('/admin/test-permission', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }

    public function testVisibleOnPageShow()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission' => [
                        'name' => 'Test-permission',
                        'url' => '/admin/test-permission',
                        'children' => [
                            'tab1' => [
                                'name' => 'tab1',
                                'url' => '/admin/test-permission/tab1/',
                                'visible' => Node::VISIBLE_TYPE_CURRENT_PAGE
                            ]
                        ]
                    ],
                ]
            ]
        ];
        $result = '<tr>
                <td >
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr><tr>
                <td >
                    <div class="menu1">
                    <a href="/admin/test-permission">Test-permission</a>
                    </div>
                </td>
            </tr><tr>
                <td class ="select">
                    <div class="menu2">
                    <a href="/admin/test-permission/tab1/">tab1</a>
                    </div>
                </td>
            </tr>';
        $menu = (new MenuGenerator('/admin/test-permission/tab1/', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }


    public function testNodeName()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
            ]
        ];
        $result = '<tr>
                <td class ="select">
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr>';
        $menu = (new MenuGenerator('/admin', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }

    public function testNodeNameWithCallBack()
    {
        $tree = [
            'admin' => [
                'name' => function () {
                    return 'Admin';
                },
                'url' => '/admin',
            ]
        ];
        $result = '<tr>
                <td class ="select">
                    <div class="menu0">
                    <a href="/admin">Admin</a>
                    </div>
                </td>
            </tr>';
        $menu = (new MenuGenerator('/admin', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }

    public function testNodeNameWithPostFix()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'namePostFix' => 'param'
            ]
        ];
        $result = '<tr>
                <td class ="select">
                    <div class="menu0">
                    <a href="/admin">Admin show_postFix</a>
                    </div>
                </td>
            </tr>';
        $_GET['param'] = 'show_postFix';
        $menu = (new MenuGenerator('/admin?param=show_postFix', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }


    public function testAddPramsToNotUrl()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'params' => ['test1', 'test2', 'test3'],
            ]
        ];
        $result = '<tr>
                <td class ="select">
                    <div class="menu0">
                    <a href="/admin?test1=test1&test2=test2&test3=test3">Admin</a>
                    </div>
                </td>
            </tr>';
        $_GET['test1'] = 'test1';
        $_GET['test2'] = 'test2';
        $_GET['test3'] = 'test3';
        $menu = (new MenuGenerator('/admin?test1=test1&test2=test2&test3=test3', $tree))->getMenu();
        $this->assertEquals($result, $menu);
    }

}