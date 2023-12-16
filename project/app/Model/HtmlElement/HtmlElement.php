<?php
declare(strict_types=1);

namespace App\Model\HtmlElement;

/**
 * @ORM\Entity
 * @ORM\Table(name="html_elements")
 */
class HtmlElement {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected int $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $tagName;

    /**
     * @ORM\Column(type="json")
     */
    protected array $attributes = [];

    public function __construct($tagName) {
        $this->tagName = $tagName;
    }

    public function setTagName($tagName): static
    {
        $this->tagName = $tagName;
        return $this;
    }


    public function getTagName(): string
    {
        return $this->tagName;
    }

    /**
     * Sets the value of the specified attribute.
     *
     * @param string $attributeName The name of the attribute.
     * @param mixed $attributeValue The value of the attribute.
     * @return HtmlElement The current instance.
     */
    public function setAttribute(string $attributeName, mixed $attributeValue): static
    {
        $this->attributes[$attributeName] = $attributeValue;
    }

    /**
     * Retrieves the attributes of the object.
     *
     * @return array The attributes of the object.
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Renders the HTML element as a string.
     *
     * @return string The HTML representation of the element.
     */
    public function render(): string
    {
        $attributesString = $this->renderAttributes();
        return "<{$this->tagName}{$attributesString}></{$this->tagName}>";
    }

    protected function renderAttributes(): string
    {
        $attributesString = '';
        foreach ($this->attributes as $name => $value) {
            $attributesString .= " $name=\"$value\"";
        }

        return $attributesString;
    }
}
