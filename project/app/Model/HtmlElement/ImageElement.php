<?php

namespace App\Model\HtmlElement;

class ImageElement extends HtmlElement
{
    public function __construct()
    {
        parent::__construct('img');
    }

    /**
     * @param string $src
     * @return $this
     */
    public function setSrc(string $src): static
    {
        return $this->setAttribute('src', $src);
    }

    /**
     * Retrieves the value of the 'src' attribute.
     * If the attribute is not set, it returns an empty string.
     *
     * @return string The value of the 'src' attribute.
     */
    public function getSrc(): string
    {
        return $this->attributes['src'] ?? '';
    }

}
