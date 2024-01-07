<?php

declare(strict_types=1);

namespace App\HtmlElement;

/**
 * Class AElement
 *
 * Represents an HTML "a" element.
 */
class AElement extends HtmlElement
{
    /**
     * @var string
     */
    private string $innerText;

    /**
     * AElement constructor
     */
    public function __construct()
    {
        parent::__construct('a');
    }

    /**
     * @param string $string
     * @return void
     */
    public function setInnerText(string $string): void
    {
        $this->innerText = $string;
    }

    /**
     * Constructs a new AElement object with the given href and text.
     *
     * @param string $href The href attribute value for the AElement.
     * @param string $text The inner text content for the AElement.
     * @return AElement The newly constructed AElement object.
     */
    public function buildAElement(string $href, string $text): AElement
    {
        $element = new self();
        $element->setAttribute('href', $href);
        $element->setInnerText($text);

        return $element;
    }

    /**
     * Renders the element as an HTML string.
     *
     * @return string The rendered HTML string.
     */
    public function render(): string
    {
        $attributesString = $this->renderAttributes();

        return "<{$this->tagName}{$attributesString}>{$this->innerText}</{$this->tagName}>";
    }
}
