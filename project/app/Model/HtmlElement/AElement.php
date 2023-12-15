<?php

namespace App\Model\HtmlElement;
class AElement extends HtmlElement
{
private string $innerText;

public function __construct()
{
parent::__construct('a');
}

public function setInnerText(string $string): void
{
$this->innerText = $string;
}

public function buildAElement(string $href, string $text): AElement
{
$this->setAttribute('href', $href);
$this->setInnerText($text);
return $this;
}

public function render(): string
{
$attributesString = $this->renderAttributes();
return "<{$this->tagName}{$attributesString}>{$this->innerText}</{$this->tagName}>";
}
}
