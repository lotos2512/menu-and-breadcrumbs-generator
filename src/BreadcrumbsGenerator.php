<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18.11.18
 * Time: 12:20
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;

class BreadcrumbsGenerator
{
    private $strategy;
    private $menuMap;
    private $url;

    public function __construct(BreadcrumbsStrategy $strategy, string $url, array $menuMap)
    {
        $this->strategy = $strategy;
        $this->url = $this->cleanUrlFromParams($url);
        $this->menuMap = $menuMap;
    }

    public function getBreadcrumbs($delimiter = ' / '): string
    {
        return $this->generateBreadCrumbs($this->strategy->getBreadCrumbs($this->menuMap, $this->url), $delimiter);
    }

    /**
     * @param string $url
     * @return string
     */
    protected function cleanUrlFromParams(string $url): string
    {
        $matches = [];
        preg_match_all('%^.([a-z\.]{2,6})([\/\w\.-]*)*\/?%', $url, $matches);
        return $matches[0][0];
    }

    /**
     * @param Node[] $nodes
     * @param string $delimiter
     * @return string
     */
    protected function generateBreadCrumbs(array $nodes, string $delimiter): string
    {
        $html = '';
        if (!count($nodes)) {
            return $html;
        }
        foreach ($nodes as $key => $node) {
            $url = ($url = $node->getUrl()) !== null ? $url : 'javascript:void(0)';
            $html .= "<a href=\"$url\">{$node->getNameWithPostFix($this->url)}</a> $delimiter";
        }
        return $html;
    }
}