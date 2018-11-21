<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18.11.18
 * Time: 12:17
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;

/**
 * Class MenuGenerator
 * @package app\menu_generator
 */
class MenuGenerator
{
    private $menuMap;
    private $url;
    private $renderStrategy;

    public function __construct(RenderStrategy $renderStrategy, string $url, array $menuMap)
    {
        $this->renderStrategy = $renderStrategy;
        $this->menuMap = $menuMap;
        $this->url = $this->cleanUrlFromParams($url);
    }

    /**
     * @param string $url
     * @return string
     */
    private function cleanUrlFromParams(string $url): string
    {
        $matches = [];
        preg_match_all('%^.([a-z\.]{2,6})([\/\w\.-]*)*\/?%', $url, $matches);
        return $matches[0][0];
    }


    /**
     * @return string
     * @throws NodeException
     */
    public function getMenu(): string
    {
        return $this->generateMenu($this->menuMap);
    }


    /**
     * @param array $tree
     * @param int $level
     * @return string
     * @throws NodeException
     */
    private function generateMenu(array $tree, int $level = 0): string
    {
        $html = '';
        foreach ($tree as $key => $branch) {
            $node = new Node($branch);
            if ($node->isVisible($this->url) === false) continue;
            if ($node->isAvailable() === false) continue;
            $localHtml = $this->renderStrategy->getHtmlBlock($node, $level, $this->url);
            if ($node->hasChildren()) {
                $childHtml = $this->generateMenu($node->getChildren(), $level + 1);
                if (strlen($childHtml)) {
                    $localHtml .= $this->renderStrategy->decorateChildHtml($childHtml);
                } else {
                    if ($node->getUrl() === null) {
                        $localHtml = '';
                    }
                }
            }
            $html .= $localHtml;
        }
        return $html;
    }
}