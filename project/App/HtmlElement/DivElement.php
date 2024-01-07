<?php

namespace App\HtmlElement;

/**
 * Class DivElement
 *
 * Represents a <div> element in HTML code.
 */
class DivElement extends FormElement
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ends a group for form elements.
     *
     * @return string : HTML
     */
    public function endGroup(): string
    {
        return '</div>';
    }
}
