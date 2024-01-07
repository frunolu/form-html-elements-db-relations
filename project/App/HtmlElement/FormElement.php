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

    public function setAttribute(string $string, string $name)
    {
    }

    /**
     * Single radio.
     *
     * @param array $option
     *
     * @return string : html
     */
    public function radioSingle(array $option)
    {
        return sprintf(
            "<label><input type=\"radio\" value=\"%s\"%s/> %s</label>",
            $option['value'],
            $this->optionAttributes($option),
            $option['label']
        );
    }

    /**
     * Single select option.
     *
     * @param array $option
     *
     * @return string : html
     */
    public function selectSingle(array $option)
    {
        return "<option value=\"{$option['value']}\"{$this->optionAttributes($option)}>{$option['label']}</option>";
    }
}
