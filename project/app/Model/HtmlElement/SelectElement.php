<?php

namespace App\Model\HtmlElement;

class SelectElement extends HtmlElement
{
    private const TAG_NAME = 'select';

    protected array $options = [];

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

    public function addOption(string $value, string $text): static
    {
        $this->options[] = ['value' => $value, 'text' => $text];

        return $this;
    }

    public function render(): string
    {
        $attributesString = $this->renderAttributes();
        $optionsString = $this->renderOptions();

        return $this->getElementString($this->tagName, $attributesString, $optionsString);
    }

    protected function getElementString(string $tag, string $attributes, string $options): string
    {
        return "<{$tag}{$attributes}>{$options}</{$tag}>";
    }

    protected function renderOptions(): string
    {
        $optionsString = '';
        foreach ($this->options as $option) {
            $optionsString .= "<option value=\"{$option['value']}\">{$option['text']}</option>";
        }

        return $optionsString;
    }

    private function addAttribute(string $string, string $name): void
    {
        $this->attributes[$string] = $name;
    }
}
