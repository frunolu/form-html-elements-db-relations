<?php

declare(strict_types=1);

namespace App\HtmlElement;

use Exception;

/**
 * Class FormElement
 *
 * Represents an HTML form element.
 *
 * @property $tagName
 * @extends HtmlElement
 * @method renderAttributes()
 */
class FormElement extends HtmlElement
{

    /**
     * @var array $children Holds an array of children elements.
     */
    protected array $children = [];

    public function __construct()
    {
        parent::__construct('form');
    }

    public static function createLabel(string $for, string $text): self
    {
        return self::createNewElement('label', ['for' => $for], $text);
    }

    private static function createNewElement(string $tagName, array $attributes, string $innerText = ''): self
    {
        $formElement = new self();
        $formElement->tagName = $tagName;
        $formElement->attributes = $attributes;
        $formElement->innerText = $innerText;

        return $formElement;
    }

    /**
     * Renders the HTML representation of the element.
     *
     * @return string Returns the rendered HTML string.
     */
    public function render(): string
    {
        $attributesString = $this->renderAttributes();
        $childrenString = $this->renderChildren();

        return "<{$this->tagName}{$attributesString}>{$childrenString}</{$this->tagName}>";
    }


    public function setAttribute(string $string, string $name)
    {
    }

    /**
     * Renders the children elements as a string.
     *
     * @return string Returns the string representation of the children elements.
     */
    protected function renderChildren(): string
    {
        $childrenString = '';
        foreach ($this->children as $child) {
            $childrenString .= $child->render();
        }

        return $childrenString;
    }

}

