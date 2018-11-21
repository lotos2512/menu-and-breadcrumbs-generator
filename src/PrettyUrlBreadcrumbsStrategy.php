<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18.11.18
 * Time: 12:57
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;

/**
 * работает только с деревьями формата
 * 'cryptography' => [
 * 'permission' => function () {
 * return true;
 * },
 * 'name' =>'Криптография',
 * 'children' => [
 * 'certificates' => [
 * 'name' =>'Сертификаты',
 * 'url' => '/admin/cryptography/certificates',
 * ],
 * 'create-request' => [
 * 'name' =>'Запрос сертификата',
 * 'url' => '/admin/cryptography/create-request',
 * ],
 * 'upload-signed-certificates' => [
 * 'name' =>'Загрузка подписанных сертификатов',
 * 'url' => '/admin/cryptography/upload-signed-certificates',
 * ]
 * ],
 * ],
 * можно использовать в фреймворках.
 * @see BreadcrumbsGenerator
 * Class PrettyUrlBreadCrumbsGenerator
 * @package app\menu_generator
 */
class PrettyUrlBreadcrumbsStrategy implements BreadcrumbsStrategy
{
    public function getBreadCrumbs(array $tree, string $url): array
    {
        $urlParts = explode('/', $url);
        if ($urlParts[0] === "") {
            unset($urlParts[0]);
        }
        $arrayBreadCrumbs = $this->searchBreadCrumbs($tree, $urlParts);
        array_walk($arrayBreadCrumbs, function (&$e) {
            $e = new Node($e);
        });
        return $arrayBreadCrumbs;
    }

    /**
     * Поиск хлебных крошек
     * @param array $tree дерово меню
     * @param array $urlParts
     * @return array массив с крошками
     */
    private function searchBreadCrumbs(array $tree, array $urlParts): array
    {
        $result = [];
        foreach ($urlParts as $key => $action) {
            if (isset($tree[$action])) {
                $result[] = $tree[$action];
                if (isset($tree[$action]['children'])) {
                    unset($urlParts[$key]);
                    $result = array_merge($result, $this->searchBreadCrumbs($tree[$action]['children'], $urlParts));
                }
            } else {
                break;
            }
        }
        return $result;
    }
}