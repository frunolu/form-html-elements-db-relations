<?php

declare(strict_types=1);
require_once 'App/HtmlElement/HtmlElement.php';
require_once 'App/HtmlElement/FormElement.php';
require_once 'App/HtmlElement/InputElement.php';


use App\HtmlElement\FormElement;
use App\HtmlElement\InputElement;

$element = new FormElement();
$input = new InputElement();

echo $element->text('music');

echo $element->text('music', ['name' => 'Name', 'id' => 'ID', 'class' => 'Class']);

echo $element->input('email', 'music@gmail.com');

echo $element->checkbox(true, ['name' => 'Name', 'id' => 'ID']);

echo $element->checkboxList(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $element->select(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $element->radio(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $input->input('email', 'music@gmail.com');
