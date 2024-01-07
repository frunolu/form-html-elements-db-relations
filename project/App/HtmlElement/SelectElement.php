<?php

namespace App\HtmlElement;

class SelectElement extends HtmlElement
{
    private const TAG_NAME = 'select';

    public $options = [];
    private $tagName;

    public function __construct()
    {
        parent::__construct(self::TAG_NAME);
    }

    public function buildSelectElement(string $name, array $options): SelectElement
    {
        $selectElement = new SelectElement();
        $selectElement->setAttribute('name', $name);

        foreach ($options as $value => $text) {
            $selectElement->addOption($value, $text);
        }

        return $selectElement;
    }

    /**
     * Adds an option to the 'options' array.
     *
     * @param  string $value The value of the option.
     * @param  string $text  The text of the option.
     * @return $this Returns the object instance for method chaining.
     */
    public function addOption(string $value, string $text): static
    {
        $this->options[] = ['value' => $value, 'text' => $text];

        return $this;
    }

    /**
     * Renders the element as a string.
     *
     * This method returns a string representation of the element after rendering
     * its attributes and options. It uses the `renderAttributes` and `renderOptions`
     * methods internally to generate the necessary HTML markup.
     *
     * @return string The rendered element as a string.
     */
    public function render(): string
    {
        $attributesString = $this->renderAttributes();
        $optionsString = $this->renderOptions();

        return $this->getElementString($this->tagName, $attributesString, $optionsString);
    }

    /**
     * Returns a string representation of an HTML element.
     *
     * @param  string $tag        The HTML tag of the element.
     * @param  string $attributes The attributes of the element.
     * @param  string $options    The content or options of the element.
     * @return string The string representation of the HTML element.
     */
    protected function getElementString(string $tag, string $attributes, string $options): string
    {
        return "<{$tag}{$attributes}>{$options}</{$tag}>";
    }

    /**
     * Render the options of a select dropdown as string.
     *
     * @return string The options as string representation.
     */
    protected function renderOptions(): string
    {
        $optionsString = '';
        foreach ($this->options as $option) {
            $optionsString .= "<option value=\"{$option['value']}\">{$option['text']}</option>";
        }

        return $optionsString;
    }

    /**
     * Adds an attribute to the list of attributes.
     *
     * @param  string $string The name of the attribute.
     * @param  string $name   The value of the attribute.
     * @return void
     */
    private function addAttribute(string $string, string $name): void
    {
        $this->attributes[$string] = $name;
    }

    private function setAttribute(string $string, string $name)
    {
    }
}

