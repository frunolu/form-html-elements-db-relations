<?php

declare(strict_types=1);
require_once 'App/HtmlElement/HtmlElement.php';
require_once 'App/HtmlElement/FormElement.php';
require_once 'App/HtmlElement/InputElement.php';
require_once 'App/HtmlElement/ImageElement.php';

var_dump(@$_SERVER['DOCUMENT_ROOT']);

use App\HtmlElement\FormElement;
use App\HtmlElement\ImageElement;
use App\HtmlElement\InputElement;

$element = new FormElement();
$input = new InputElement();
$image = new ImageElement();

echo $element->text('music');

echo $element->text('music', ['name' => 'Name', 'id' => 'ID', 'class' => 'Class']);

echo $element->input('email', 'music@gmail.com');

echo $element->checkbox(true, ['name' => 'Name', 'id' => 'ID']);

echo $element->checkboxList(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $element->select(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $element->radio(['song'], ['name' => 'Name', 'id' => 'ID'], ['song 1' => 'song 1', 'song 2' => 'song 2']);

echo $input->input('email', 'music@gmail.com');

echo $input->input('button', 'submit', ['name' => 'submitButton', 'value' => 'Submit']);

echo $element->dropdown(
    ['song'],
    ['name' => 'Name', 'id' => 'ID'],
    ['song 1' => 'song 1', 'song 2' => 'song 2']
);

echo $element->multiselect(
    ['song1', 'song2'],
    ['name' => 'MySelect', 'id' => 'MyID', 'class' => 'MyClass'],
    [
        'song 1' => 'song 1',
        'song 2' => 'song 2',
        'song 3' => 'song 3',
        'song 4' => 'song 4',
        'song 5' => 'song 5',
        'song 6' => 'song 6',
        'song 7' => 'song 7'
    ]
);

echo $image->get('/www/img/music.jpg', ['alt' => 'Image alt'], ['jpx']);
