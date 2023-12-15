<?php

namespace App\Model\HtmlElement;

class ImageElement extends HtmlElement
{
    public function __construct()
    {
        parent::__construct('img');
    }

    public function setSrc(string $src): static
    {
        return $this->setAttribute('src', $src);
    }

    public function getSrc(): string
    {
        return $this->attributes['src'] ?? '';
    }

}
