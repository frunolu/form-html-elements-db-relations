<?php

namespace App\HtmlElement;

class SelectElement extends HtmlElement
{
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
     * Returns a string representation of an HTML element.
     *
     * @param  string $tag        The HTML tag of the element.
     * @param  string $attributes The attributes of the element.
     * @param  string $options    The content or options of the element.
     * @return string The string representation of the HTML element.
     */
    public function getElementString(string $tag, string $attributes, string $options): string
    {
        return "<{$tag}{$attributes}>{$options}</{$tag}>";
    }

    /**
     * Render the options of a select dropdown as string.
     *
     * @return string The options as string representation.
     */
    public function renderOptions(): string
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
}
