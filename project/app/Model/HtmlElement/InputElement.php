<?php

declare(strict_types=1);

namespace App\Model\HtmlElement;

class InputElement extends HtmlElement
{
    private const TAG_NAME = 'input';

    public function __construct()
    {
        parent::__construct(self::TAG_NAME);
    }

    /**
     * Builds an instance of InputElement with the specified type, name, and placeholder.
     *
     * @param string $type        The type attribute of the input element.
     * @param string $name        The name attribute of the input element.
     * @param string $placeholder The placeholder attribute of the input element.
     *
     * @return InputElement The newly created InputElement instance with the specified attributes.
     */
    public function buildInputElement(string $type, string $name, string $placeholder): self
    {
        return (new self())
            ->setAttribute('type', $type)
            ->setAttribute('name', $name)
            ->setAttribute('placeholder', $placeholder);
    }
}
