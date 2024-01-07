<?php

declare(strict_types=1);
require_once 'App/HtmlElement/HtmlElement.php';
require_once 'App/HtmlElement/FormElement.php';

use App\HtmlElement\FormElement;

$element = new FormElement();

echo "hello";

//var_dump($_SERVER['DOCUMENT_ROOT']);
echo $element->text('music');

echo $element->text('music', ['name' => 'Name', 'id' => 'ID', 'class' => 'Class']);

echo $element->input('email', 'music@gmail.com');

echo $element->checkbox(true, ['name' => 'Name', 'id' => 'ID']);

echo $element->checkboxList(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $element->select(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $element->radio(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

