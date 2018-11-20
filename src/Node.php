<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 18.11.18
 * Time: 15:05
 */

namespace lotos2512\menuAndBreadcrumbsGenerator;

/**
 * Class Node
 * @package app\menu_generator
 */
class Node
{
    public const VISIBLE_TYPE_CURRENT_PAGE = 'onPage';

    private $url;
    private $name;
    private $children;
    private $visible;
    private $namePostFix;
    private $params;
    private $permission;

    /**
     * Node constructor.
     * @param array $attributes
     * @throws NodeException
     */
    public function __construct(array $attributes)
    {
        if (!isset($attributes['name'])) {
            throw new NodeException('required attribute not find');
        }
        foreach ($attributes as $name => $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            } else {
                throw new NodeException("property {{ $name }} of class ".self::class." is not exists");
            }
        }
    }

    /**
     * @return bool
     */
    public function isAvailable(): bool
    {
        if ($this->permission !== null) {
            if (is_callable($this->permission)) {
                return call_user_func($this->permission);
            } else {
                return (bool)$this->permission;
            }
        }
        return true;
    }

    public function isVisible(? string $url = null): bool
    {
        if ($this->visible !== null) {
            if ($this->visible === self::VISIBLE_TYPE_CURRENT_PAGE) {
                return $this->quailsUrl($url);
            }
        }
        return true;
    }

    public function quailsUrl(string $url): bool
    {
        return $this->url === $url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function getUrlWithParams(string $url): ?string
    {
        if (($url = $this->url) !== null && $this->params !== null) {
            if ($this->url == $url) {
                $url = $this->addParamsOnUrl($url, $this->params);
            }
        }
        return $url;
    }

    /**
     * Добавление параметров на ссылку
     * @param string $url
     * @param array $params
     * @return string
     */
    protected function addParamsOnUrl(string $url, array $params): string
    {
        $data = [];
        foreach ($params as $key => $param) {
            if (isset($_GET[$param])) {
                $data[$param] = $_GET[$param];
            }
        }
        return $url . '?' . http_build_query($data);
    }

    public function getName(): string
    {
        if (is_callable($this->name)) {
            $label = call_user_func($this->name);
        } else {
            $label = $this->name;
        }
        return $label;
    }

    public function getNameWithPostFix(string $currentUrl): string
    {
        if (is_callable($this->name)) {
            $label = call_user_func($this->name);
        } else {
            $label = $this->name;
        }
        if ($currentUrl == $this->url && $this->namePostFix !== null) {
            $label .= " " . @$_GET[$this->namePostFix];
        }
        return $label;
    }

    public function hasChildren(): bool
    {
        return $this->children !== null;
    }

    public function getChildren(): array
    {
        return $this->children;
    }
}