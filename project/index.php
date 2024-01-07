<?php

declare(strict_types=1);

echo "hello";


use App\HtmlElement\FormElement;

/**
 * Create a text field with default value
 */
echo FormElement::text('Some text');

/**
 * Create a text field with default value, name, id and class attributes
 */
echo FormElement::text('Some text', ['name' => 'Name', 'id' => 'ID', 'class' => 'Class']);

/**
 * Create an email input field
 */
echo FormElement::input('email', 'noreply@gmail.com');

/**
 * Create a checkbox with default checked and with name and id attributes
 */
echo FormElement::checkbox(true, ['name' => 'Name', 'id' => 'ID']);

/**
 * Create a list of checkboxes with default values
 */
echo FormElement::checkboxList(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Create a select with default value, name and id attributes
 */
echo FormElement::select(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Alies select
 */
echo FormElement::dropdown(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Create a list of radio
 */
echo FormElement::radio(['cat'], ['name' => 'Name', 'id' => 'ID'], ['dog' => 'Dog', 'cat' => 'Cat']);

/**
 * Create a lebel with label text, id, class and for attributes
 */
echo FormElement::label('Some text', ['id' => 'ID', 'class' => 'Class', 'for' => 'for']);
