<?php

declare(strict_types=1);

require_once 'App/HtmlElement/HtmlElement.php';
require_once 'App/HtmlElement/FormElement.php';
echo "hello";

use App\HtmlElement\FormElement;

/**
 * Create a text field with default value
 */
echo (new App\HtmlElement\FormElement)->text('Some text');

/**
 * Create a text field with default value, name, id and class attributes
 */
echo (new App\HtmlElement\FormElement)->text('Some text', ['name' => 'Name', 'id' => 'ID', 'class' => 'Class']);

/**
 * Create an email input field
 */
echo (new App\HtmlElement\FormElement)->input('email', 'noreply@gmail.com');

/**
 * Create a checkbox with default checked and with name and id attributes
 */
echo (new App\HtmlElement\FormElement)->checkbox(true, ['name' => 'Name', 'id' => 'ID']);

/**
 * Create a list of checkboxes with default values
 */
echo (new App\HtmlElement\FormElement)->checkboxList(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Create a select with default value, name and id attributes
 */
echo (new App\HtmlElement\FormElement)->select(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Alies select
 */
echo (new App\HtmlElement\FormElement)->select(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Create a list of radio
 */
echo (new App\HtmlElement\FormElement)->radio(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Create a lebel with label text, id, class and for attributes
 */
echo FormElement::label('Some text', ['id' => 'ID', 'class' => 'Class', 'for' => 'for']);
