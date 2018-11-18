<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18.11.18
 * Time: 14:41
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;


interface BreadcrumbsStrategy
{
    /**
     * @param array $map
     * @param string $url
     * @return Node[]
     */
    public function getBreadCrumbs(array $map, string $url): array;
}