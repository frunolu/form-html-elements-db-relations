<?php

declare(strict_types=1);

namespace App\HtmlElement;

class InputElement extends FormElement
{
    public $inputTypes = [
        'button',
        'checkbox',
        'color',
        'date',
        'datetime',
        'datetime-local',
        'email',
        'file',
        'hidden',
        'image',
        'month',
        'number',
        'password',
        'radio',
        'range',
        'reset',
        'search',
        'submit',
        'tel',
        'text',
        'time',
        'url',
        'week',
    ];

    /**
     * Generate html input.
     *
     * @param string $type:
     *            Input type attribute
     * @param string $default:
     *            Default value attribute
     * @param array $attributes
     *
     * @return string : Generic html input
     */
    public function input($type, $default = null, array $attributes = [])
    {
        $this->setProperties($type, $default, $attributes);
        $this->refineInputAttributes();

        return $this->createInput();
    }



    /**
     * Attributes configurations.
     *
     * @var array
     */
    public $attributesConfig = [
        'value' => [
            '_escape_function' => 'esc_attr',
        ],
        'id' => [
            '_escape_function' => 'esc_attr',
        ],
        'class' => [
            '_escape_function' => 'esc_attr',
        ],
        'src' => [
            '_escape_function' => 'esc_url',
        ],
        'href' => [
            '_escape_function' => 'esc_url',
        ],
    ];
}
