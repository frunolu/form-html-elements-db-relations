<?php

namespace App\Model\HtmlElement;

class FormElement extends HtmlElement
{
    protected array $children = [];

    public function __construct()
    {
        parent::__construct('form');
    }

    public function addInput(InputElement $input): static
    {
        $this->children[] = $input;

        return $this;
    }

    public function addSelect(SelectElement $select): static
    {
        $this->children[] = $select;

        return $this;
    }

    public function addImage(ImageElement $image): static
    {
        $this->children[] = $image;

        return $this;
    }

    public function render(): string
    {
        $attributesString = $this->renderAttributes();
        $childrenString = $this->renderChildren();

        return "<{$this->tagName}{$attributesString}>{$childrenString}</{$this->tagName}>";
    }

    protected function renderChildren(): string
    {
        $childrenString = '';
        foreach ($this->children as $child) {
            $childrenString .= $child->render();
        }

        return $childrenString;
    }

    public function addFormItem(HtmlElement $formItem): static
    {
        $this->children[] = $formItem;

        return $this;
    }

    public function setAction(string $link): static
    {
        $this->setAttribute('action', $link);

        return $this;
    }
}
