<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 21.11.18
 * Time: 17:44
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;


abstract class RenderStrategy
{
    abstract public function getHtmlBlock(Node $node, int $level, string $currentUr) : string;
}