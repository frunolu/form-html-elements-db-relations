<?php

declare(strict_types=1);

namespace App\HtmlElement;

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

        /**
         * @param string $string
         * @param string $name
         * @return void
         */
        public function setAttributes(string $string, string $name): void
    {
        $this->attributes[$string] = $name;
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
        return $this->generateRadioHtml($option['value'], $this->optionAttributes($option), $option['label']);
    }

    /**
     * Generate the HTML string for a single radio button.
     *
     * @param string $value
     * @param string $attributes
     * @param string $label
     * @return string
     */
    public function generateRadioHtml(string $value, string $attributes, string $label): string
    {
        return "<label><input type=\"radio\" value=\"".$value."\"".$attributes."/> ".$label."</label>";
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
