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

    public function __construct(string $url, array $menuMap)
    {
        $this->menuMap = $menuMap;
        $this->url = $this->cleanUrlFromParams($url);
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
    protected function generateMenu(array $tree, int $level = 0): string
    {
        $html = '';
        foreach ($tree as $key => $branch) {
            $node = new Node($branch);
            if ($node->isVisible($this->url) === false) continue;
            if ($node->isAvailable() === false) continue;
            $localHtml = $this->getHtmlBlock($node, $level);
            if ($node->hasChildren()) {
                $childHtml = $this->generateMenu($node->getChildren(), $level + 1);
                if (strlen($childHtml)) {
                    $localHtml .= $childHtml;
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

    protected function getHtmlBlock(Node $node, int $level): string
    {
        return strtr($this->htmlTemplate(), $this->getHtmlBlockParams($node, $level));
    }


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