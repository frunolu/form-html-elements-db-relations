<?php

namespace App\Model\HtmlElement;

/**
 * Class DivElement
 *
 * Represents a <div> element in HTML code.
 */
class DivElement extends HtmlElement
{
    public function __construct()
    {
        parent::__construct('div');
    }
}
