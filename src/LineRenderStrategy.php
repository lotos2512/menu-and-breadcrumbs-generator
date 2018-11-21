<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 21.11.18
 * Time: 17:48
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;


class LineRenderStrategy extends RenderStrategy
{
    public function getHtmlBlock(Node $node, int $level, string $currentUrl) : string
    {
        return strtr(
            $this->htmlTemplate(), [
            'tdClass' => $node->quailsUrl($currentUrl) === true ? 'class ="select"' : null,
            'menuClass' => "menu$level",
            'url' => $node->getUrlWithParams($currentUrl),
            'name' => $node->getNameWithPostFix($currentUrl),
        ]);
    }

    protected function htmlTemplate() : string
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