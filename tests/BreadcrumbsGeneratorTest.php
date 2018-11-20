<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 20.11.18
 * Time: 22:38
 */

namespace lotos2512\menuAndBreadcrumbsGenerator\tests;

use lotos2512\menuAndBreadcrumbsGenerator\BreadcrumbsGenerator;
use lotos2512\menuAndBreadcrumbsGenerator\PrettyUrlBreadcrumbsStrategy;
use lotos2512\menuAndBreadcrumbsGenerator\RecursiveBreadcrumbsStrategy;
use PHPUnit\Framework\TestCase;

class BreadcrumbsGeneratorTest extends TestCase
{
    public function testGenerateBreadcrumbs()
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
        $result = '<a href="/admin">Admin</a>  / <a href="/admin/test-permission">Test-permission</a>  / <a href="/admin/test-permission/tab1/">tab1</a>  / ';
        $breadcrumbs = (new BreadcrumbsGenerator(new RecursiveBreadcrumbsStrategy(), '/admin/test-permission/tab1/', $tree))->getBreadcrumbs();
        $this->assertEquals($result, $breadcrumbs);
    }


    public function testGenerateBreadcrumbsWithCustomSeparator()
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
        $result = '<a href="/admin">Admin</a>  ### <a href="/admin/test-permission">Test-permission</a>  ### <a href="/admin/test-permission/tab1/">tab1</a>  ### ';
        $breadcrumbs = (new BreadcrumbsGenerator(new RecursiveBreadcrumbsStrategy(), '/admin/test-permission/tab1/', $tree))->getBreadcrumbs(' ### ');
        $this->assertEquals($result, $breadcrumbs);
    }


    public function testGenerateBreadcrumbsWithPrettyUrlBreadcrumbsStrategy()
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
        $result = '<a href="/admin">Admin</a>  / <a href="/admin/test-permission">Test-permission</a>  / <a href="/admin/test-permission/tab1/">tab1</a>  / ';
        $breadcrumbs = (new BreadcrumbsGenerator(new PrettyUrlBreadcrumbsStrategy(), '/admin/test-permission/tab1/', $tree))->getBreadcrumbs();
        $this->assertEquals($result, $breadcrumbs);
    }


    public function testGenerateBreadcrumbsWithPrettyUrlBreadcrumbsStrategyWithNotValidTree()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission.php' => [
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
        $result = '<a href="/admin">Admin</a>  / ';
        $breadcrumbs1 = (new BreadcrumbsGenerator(new PrettyUrlBreadcrumbsStrategy(), '/admin/test-permission/tab1/', $tree))->getBreadcrumbs();
        $this->assertEquals($result, $breadcrumbs1);
    }


    public function testGenerateBreadcrumbsWithRecursiveBreadcrumbsStrategyWithNotValidTree()
    {
        $tree = [
            'admin' => [
                'name' => 'Admin',
                'url' => '/admin',
                'children' => [
                    'test-permission.php' => [
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
        $result = '<a href="/admin">Admin</a>  / <a href="/admin/test-permission">Test-permission</a>  / <a href="/admin/test-permission/tab1/">tab1</a>  / ';
        $breadcrumbs1 = (new BreadcrumbsGenerator(new RecursiveBreadcrumbsStrategy(), '/admin/test-permission/tab1/', $tree))->getBreadcrumbs();
        $this->assertEquals($result, $breadcrumbs1);
    }
}