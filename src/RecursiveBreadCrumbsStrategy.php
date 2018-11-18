<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18.11.18
 * Time: 17:15
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;

/**
 * Использует рекурсивный поиск в глубь для нахождния крошек, будет работать с либым форматом
[
    'instructions.php' => [
        'url' => '/admin/instructions.php',
        'name' =>'Инструкции',
    ],
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
 * Class RecursiveBreadCrumbsStrategy
 * @package app\menu_generator
 */
class RecursiveBreadCrumbsStrategy implements BreadChumsStrategy
{
    protected $url;

    /**
     * @param array $tree
     * @param string $url
     * @return Node[]
     * @throws NodeException
     */
    public function getBreadCrumbs(array $tree, string $url): array
    {
        $this->url = $url;
        return $this->searchBreadCrumbs($tree);
    }

    /**
     * @param array $tree
     * @return array
     * @throws NodeException
     */
    protected function searchBreadCrumbs(array $tree): array
    {
        foreach ($tree as $key => $node) {
            $node = new Node($node);
            if ($node->isVisible($this->url) === false) continue;
            if ($node->isAvailable() === false) continue;

            if ($node->quailsUrl($this->url)) {
                return [$node];
            }
            if ($node->hasChildren()) {
                $breadCrumb = $this->searchBreadCrumbs($node->getChildren());
                if (!empty($breadCrumb)) {
                    return array_merge([$node], $breadCrumb);
                }
            }
        }
        return [];
    }
}