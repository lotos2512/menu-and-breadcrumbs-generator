<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 21.11.18
 * Time: 17:56
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;


class TreeRenderStrategy extends RenderStrategy
{
    public function getHtmlBlock(Node $node, int $level, string $currentUrl) : string
    {
        return "<li><a href=\"{$node->getUrl()}\">{$node->getName()}</a>";
    }
}