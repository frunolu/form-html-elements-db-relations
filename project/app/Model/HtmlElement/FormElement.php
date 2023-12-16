<?php

namespace App\Model\HtmlElement;

/**
 * Class FormElement
 *
 * Represents an HTML form element.
 *
 * @extends HtmlElement
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

    /**
     * Adds an input element to the list of children.
     *
     * @param  InputElement $input The input element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addInput(InputElement $input): static
    {
        $this->children[] = $input;

        return $this;
    }

    /**
     * Adds a select element to the list of children.
     *
     * @param  SelectElement $select The select element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addSelect(SelectElement $select): static
    {
        $this->children[] = $select;

        return $this;
    }

    /**
     * Adds an image element to the list of children.
     *
     * @param  ImageElement $image The image element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addImage(ImageElement $image): static
    {
        $this->children[] = $image;

        return $this;
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

    /**
     * Adds an HTML form item element to the list of children.
     *
     * @param  HtmlElement $formItem The HTML form item element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addFormItem(HtmlElement $formItem): static
    {
        $this->children[] = $formItem;

        return $this;
    }

    /**
     * Sets the action attribute of the element.
     *
     * @param  string $link The URL or URI to which the form data will be submitted.
     * @return $this Returns the instance of the current class.
     */
    public function setAction(string $link): static
    {
        $this->setAttribute('action', $link);

        return $this;
    }
}
