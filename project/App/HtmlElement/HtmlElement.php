<?php
namespace App\HtmlElement;

use Exception;

class HtmlElement
{
    public function setAttribute()
    {

    }

    /**
     * Generate meta tag.
     *
     * @param array $attributes:
     * @return string html
     */
    protected function meta(array $attributes = [])
    {
        return $this->singleTag('meta', $attributes);
    }

    /**
     * Generate img tag.
     *
     * @param array $attributes:
     * @return string html
     */
    protected function img(array $attributes = [])
    {
        return $this->singleTag('img', $attributes);
    }

    /**
     * Generate base tag.
     *
     * @param array $attributes:
     * @return string html
     */
    protected function base(array $attributes = [])
    {
        return $this->singleTag('base', $attributes);
    }

    /**
     * Generate link tag.
     *
     * @param array $attributes:
     * @return string html
     */
    protected function link(array $attributes = [])
    {
        return $this->singleTag('link', $attributes);
    }

    /**
     * Generate frame tag.
     *
     * @param array $attributes:
     * @return string html
     */
    protected function frame(array $attributes = [])
    {
        return $this->singleTag('frame', $attributes);
    }

    /**
     * Generate single line tag
     *
     * @param string $type
     * @param array $attributes
     * @return string html
     */
    protected function singleTag($type, array $attributes = [])
    {
        $this->setProperties($type, '', $attributes);

        return $this->_publish("<{$type}{$this->attributes()}/>");
    }

//    /**
//     * Generate html tag.
//     *
//     * @param string $type:
//     *            tag type, e.g. p, div, label
//     * @param string $default:
//     *            Text for element
//     * @param array $attributes:
//     *            (optional)
//     *
//     * @return string : html
//     */
//    protected function tag($type, $default = null, array $attributes = [])
//    {
//        $this->setProperties($type, $default, $attributes);
//
//        return $this->_publish("<{$type}{$this->attributes()}>$default</$type>");
//    }

    /**
     * Counting number of options.
     */
    private $optionCount = 0;

    /**
     * Alias of select method.
     *
     * @param string|null $default:
     *            Default selected value
     * @param array $attributes
     * @param array $options:
     *            Dropdown options
     *
     * @return string : html select
     */
    public function dropdown(string $default = null, array $attributes = [], array $options = []): string
    {
        return $this->select($default, $attributes, $options);
    }

    /**
     * Generate html select.
     *
     * @param string $default:
     *            Default selected value
     * @param array $attributes
     * @param array $options:
     *            Dropdown options
     *
     * @return string : html select
     */
    public function select($default = null, array $attributes = [], array $options = []): string
    {
        $this->setProperties('select', $default, $attributes, $options);

        $html = $this->addLabel();

        $html .= "<select{$this->attributes()}>{$this->buildOptions()}</select>";

        return $this->_publish($html);
    }

    /**
     * Generate multiselect.
     *
     * @param
     *            string | array $default: Default selected value
     * @param array $attributes
     * @param array $options:
     *            Dropdown options
     *
     * @return string : html multiselect
     */
    public function multiselect($default = [], array $attributes = [], array $options = []): string
    {
        $this->setProperties('multiselect', $default, $attributes, $options);

        $html = $this->addLabel();

        $html .= "<select{$this->attributes()} multiple=\"multiple\">{$this->buildOptions()}</select>";

        return $this->_publish($html);
    }

    /**
     * Generate list of radios.
     *
     * @param string $default:
     *            Default checked value
     * @param array $attributes
     * @param array $options:
     *            Dropdown options
     *
     * @return string : html radio
     */
    protected function radioList($default = null, array $attributes = [], array $options = []): string
    {
        $this->setProperties('radio', $default, $attributes, $options);

        $html = $this->addLabel();

        $html .= $this->buildOptions();

        return $html;
    }

    /**
     * Generate list of checkboxes.
     *
     * @param
     *            string | array $default: Default checked value
     * @param array $attributes
     * @param array $options:
     *            Dropdown options
     *
     * @return string : html checkboxes
     */
    public function checkboxList($default = null, array $attributes = [], array $options = []): string
    {
        $this->setProperties('checkboxList', $default, $attributes, $options);

        $html = $this->addLabel();

        $html .= $this->buildOptions();

        return $html;
    }

    /**
     * Set $this->options.
     *
     * Examine for each option element
     * if element contains 'value' and 'label': unchanged
     * elseif element is an array and type=optgroup: unchanged
     * - otherwise key=key, val=[label, ...]
     * in case of string: key | val
     *
     * @param array $options:
     */
    protected function setOptions(array $options): void
    {
        if (empty($options)) {
            return;
        }

        $isIndexedArray = $options === array_values($options);
        $isIntegerKeys = $this->_isIntegerKeys($options);

        $opt = [];
        foreach ($options as $key => $attr) {
            $single = [];
            if (isset($attr['value']) && isset($attr['label'])) {
                $single = $attr;
            } elseif (is_array($attr)) {
                if (isset($attr['type']) && 'optgroup' == $attr['type']) {
                    $single = $attr;
                } else {
                    $single['value'] = $key;
                    list ($label, $attr) = $this->_splitFirstFromArray($attr);
                    $single['label'] = $label;
                    foreach ($attr as $k => $v) {
                        $single[$k] = $v;
                    }
                }
            } elseif ($this->isString($attr)) {
                if ($isIndexedArray) {
                    $single['value'] = $attr;
                } elseif ($isIntegerKeys) {
                    $single['value'] = $key;
                } else {
                    $single['value'] = is_int($key) ? $attr : $key;
                }
                $single['label'] = $attr;
            }

            $opt[] = $single;
        }

        $this->options = $opt;
    }

    /**
     * Building options attributes.
     *
     * @param array $option
     * @return string : html atributes
     */
    protected function optionAttributes(array $option): string
    {
        ++ $this->optionCount;

        $attributes = [];

        if (! in_array($this->type, [
            'select',
            'multiselect',
        ])) {
            $attributes = $this->_getRefinedAttributes();
        }

        $attributes = array_merge($attributes, $option, $this->getSelectedAttribute($option));

        $this->refineOptionsAttributes($attributes);

        return $this->toString($attributes);
    }

    /**
     * Building optgroup | groups attributes.
     *
     * @param array $option
     * @return string : html atributes
     */
    protected function groupAttributes(array $option): string
    {
        $attributes = $this->removeKeys($option, [
            'type',
            'label',
        ]);

        return $this->toString($attributes);
    }

    /**
     * Apply refinement to options attributes, call by reference.
     *
     * @param array $attributes
     * @return array : $attributes
     */
    protected function refineOptionsAttributes(array &$attributes): array
    {
        foreach ($attributes as $key => $val) {
            if ($this->type == 'checkboxList' && $key == 'name' && $val) {
                // We can pass `[]` directly to name attributes if needed
                // $attributes[$key] = "{$val}[]";
            }

            if (in_array($this->type, [
                    'radio',
                    'checkboxList',
                ]) && $key == 'id' && $val) {
                $attributes[$key] = "{$val}_{$this->optionCount}";
            }
        }

        $attributes = $this->removeKeys($attributes, [
            'value',
            'label',
        ]);

        return $attributes;
    }

    /**
     * Get selected/checked attribute.
     *
     * @param array $option :
     *            single option or attributes contains key 'value'
     *
     * @return array : e.g. ['checked' => 'checked'] | []
     * @throws Exception
     */
    protected function getSelectedAttribute(array $option): array
    {
        switch ($this->type) {
            case 'select':
            case 'multiselect':
                $key = 'selected';
                break;

            case 'radio':
            case 'checkbox':
            case 'radioList':
            case 'checkboxList':
                $key = 'checked';
                break;

            default:
                throw new \Exception('selected or checked attribute is not available for ' . $this->type);
        }

        if ($this->default === true) {
            return [
                $key => $key,
            ];
        }

        if (empty($option['value']) || empty($this->default)) {
            return [];
        }

        if (is_array($this->default)) {
            return in_array($option['value'], $this->default) ? [
                $key => $key,
            ] : [];
        } else {
            return $this->default == $option['value'] ? [
                $key => $key,
            ] : [];
        }

        return [];
    }

    /**
     * Front method for building option.
     * Each options array should iterate through this method.
     *
     * @return string : option html
     */
    protected function buildOptions()
    {
        $html = '';
        foreach ($this->options as $option) {
            if (! empty($option['type']) && $option['type'] == 'optgroup') {
                if (isset($option['label']) && $option['label'] == '__end__') {
                    $html .= $this->groupEnd();
                    $inGroup = false;
                } else {
                    if (! empty($inGroup)) {
                        $html .= $this->groupEnd();
                    }

                    $html .= $this->groupStart($option);
                    $inGroup = true;
                }
            } else {
                $html .= $this->_buildSingleOption($option);
            }
        }

        if (! empty($inGroup)) {
            $html .= $this->groupEnd();
        }

        return $html;
    }

    /**
     * Building single option.
     * Used only by value contaning option not groups.
     *
     * @param array $option
     *
     * @return string : option html
     */
    protected function _buildSingleOption(array $option)
    {
        $option = $this->addKeys($option, [
            'value',
            'label',
        ]);
        $optionRefined = $this->removeKeys($option, [
            '_option_before',
            '_option_after',
        ]);

        return $this->_optionEnclose($option, 'before') . $this->callMethod('Single', $optionRefined) . $this->_optionEnclose($option, 'after');
    }

    /**
     * Adding option_before and option_after to single option's string.
     *
     * @param array $option
     * @param string $key
     *            : before | after
     *
     * @return string : text
     */
    protected function _optionEnclose(array $option, $key = 'before')
    {
        if (isset($option["_option_$key"])) {
            return $option["_option_$key"];
        } elseif (isset($this->attributes["_option_$key"])) {
            return $this->attributes["_option_$key"];
        }

        return '';
    }

    /**
     * Starting tag of group.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function groupStart(array $option)
    {
        $option = $this->addKeys($option, [
            'label',
        ]);

        return $this->callMethod('GroupStart', $option);
    }

    /**
     * Ending tag of group.
     *
     * @return string : html
     */
    protected function groupEnd()
    {
        return $this->callMethod('groupEnd');
    }

    /**
     * Calling underlaying method based on slug and $this->type.
     *
     * @param string $slug:
     *            _{$this->type}{$slug}
     *
     * @return callback
     */
    protected function callMethod($slug, $arg1 = null)
    {
        $methodName = "_{$this->type}{$slug}";
        if (method_exists($this, $methodName)) {
            return $this->$methodName($arg1);
        } else {
            throw new Exception(get_class($this) . "::$methodName() does not exists!");
        }
    }

    /**
     * Single select option.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _selectSingle(array $option)
    {
        return "<option value=\"{$option['value']}\"{$this->optionAttributes($option)}>{$option['label']}</option>";
    }

    /**
     * Single multiselect option.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _multiselectSingle(array $option)
    {
        return $this->_selectSingle($option);
    }

    /**
     * Single radio.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _radioSingle(array $option)
    {
        return "<label><input type=\"radio\" value=\"{$option['value']}\"{$this->optionAttributes($option)}/> {$option['label']}</label>";
    }

    /**
     * Single checkbos.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _checkboxListSingle(array $option): string
    {
        return "<label><input type=\"checkbox\" value=\"{$option['value']}\"{$this->optionAttributes($option)}/> {$option['label']}</label>";
    }

    /**
     * Group start for select.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _selectGroupStart(array $option)
    {
        return "<optgroup label=\"{$option['label']}\"{$this->groupAttributes($option)}>";
    }

    /**
     * Group start for multiselect.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _multiselectGroupStart(array $option)
    {
        return $this->_selectGroupStart($option);
    }

    /**
     * Group start for radio.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _radioGroupStart(array $option)
    {
        return "<div><label{$this->groupAttributes($option)}>{$option['label']}</label><br />";
    }

    /**
     * Group start for checkboxList.
     *
     * @param array $option
     *
     * @return string : html
     */
    protected function _checkboxListGroupStart($option)
    {
        return $this->_radioGroupStart($option);
    }

    /**
     * Group end for select.
     *
     * @return string : html
     */
    protected function _selectGroupEnd()
    {
        return '</optgroup>';
    }

    /**
     * Group end for multiselect.
     *
     * @return string : html
     */
    protected function _multiselectGroupEnd()
    {
        return '</optgroup>';
    }

    /**
     * Group end for radio.
     *
     * @return string : html
     */
    protected function _radioGroupEnd()
    {
        return '</div>';
    }

    /**
     * Group end for checkboxList.
     *
     * @return string : html
     */
    protected function _checkboxListGroupEnd(): string
    {
        return '</div>';
    }

    /**
     * Check if all keys of given array are integer
     *
     * @param array $array
     * @return boolean
     */
    private function _isIntegerKeys(array $array)
    {
        return count(array_filter(array_keys($array), 'is_int')) == count($array);
    }

    /**
     * Input type.
     */
    public $type;

    /**
     * Default value.
     */
    public $default;

    /**
     * Input attributes.
     */
    public $attributes = [];

    /**
     * Options array for select | multiselect | radio | checkboxList.
     */
    public $options = [];

    /**
     * Construct method is used for building collection.
     * That's why parameter order is different than other element.
     *
     * @param string $type
     * @param array $attributes
     */
    public function __construct($type = null, array $attributes = [])
    {
        $this->type = $type;
        $this->attributes = $attributes;
        $this->default = [];
    }

    /**
     * Include collection into existing element
     *
     * @param string|null $type
     * @param array $attributes
     * @return HtmlElement
     */
    public function import(string $type = null, array $attributes = []): HtmlElement
    {
        $instance = new static($type, $attributes);
        $this->default[] = $instance;
        return $instance;
    }

    /**
     * Add html to collection
     *
     * @param
     *            Html object | string $html
     */
    public function add($html)
    {
        try {
            $this->default[] = is_object($html) ? $html->render() : $html;
        } catch (\Exception $e) {
            echo 'Exception: ', $e->getMessage(), "\n";
        }
    }

    /**
     * render collection elements
     *
     * @return string|null html
     */
    public function render(): ?string
    {
        $type = $this->type ?: '';
        $html = null;
        foreach ($this->default as $element) {
            if ($this->isString($element)) {
                $html .= $element;
            } elseif ($element instanceof HtmlElement) {
                $html .= $element->render();
            }
        }

        return $type ? static::$type($html, $this->attributes) : $html;
    }

    /**
     * Generate text input.
     *
     * @param string $default:
     *            Default value attribute
     * @param array $attributes:
     *            (optional)
     *
     * @return string : html text input
     */
    public function text($default = null, array $attributes = [])
    {
        return $this->input('text', $default, $attributes);
    }

    /**
     * Generate textarea.
     *
     * @param string|null $default:
     *            Inside text for textarea
     * @param array $attributes:
     *            (optional)
     *
     * @return string : html textarea
     */
    protected function textarea(string $default = null, array $attributes = []): string
    {
        return $this->tag('textarea', \esc_textarea($default), $attributes);
    }

    /**
     * Generate a single checkbox or list of checkboxes.
     *
     * @param bool $default:
     *            true, 1 or any value for checked and false or 0 for unchecked
     * @param array $attributes:
     *            (optional)
     * @param array $options:
     *            Generate list of checkbox when $options is not empty
     *
     * @return string : html checkbox
     */
    public function checkbox(bool $default = false, array $attributes = [], array $options = []): string
    {
        if (! empty($options)) {
            return $this->checkboxList($default, $attributes, $options);
        }

        return $this->_singleCheckboxRadio('checkbox', $default, $attributes);
    }

    /**
     * Generate a single radio or list of radios.
     *
     * @param bool $default:
     *            true, 1 or any value for checked and false or 0 for unchecked
     * @param array $attributes:
     *            (optional)
     * @param array $options:
     *            Generate list of radios when $options is not empty
     *
     * @return string : html checkbox
     */
    public function radio($default = false, array $attributes = [], array $options = [])
    {
        if (! empty($options)) {
            return $this->radioList($default, $attributes, $options);
        }

        return $this->_singleCheckboxRadio('radio', $default, $attributes);
    }

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
        $this->_refineInputAttributes();

        return $this->_createInput();
    }

    private function _singleCheckboxRadio($type, $default, $attributes)
    {
        $this->setProperties($type, $default, $attributes);
        $this->_refineInputAttributes();

        $this->attributes['value'] = ! empty($attributes['value']) ? $attributes['value'] : '1';

        $this->attributes = array_merge($this->attributes, $this->getSelectedAttribute($this->attributes));

        return $this->_createInput();
    }

    /**
     * Creating input.
     *
     * @return string html
     */
    private function _createInput()
    {
        $html = $this->addLabel();
        $html .= '<input' . $this->attributes() . '/>';

        return $this->_publish($html);
    }

    /**
     * Every generated element should call this function before returning final output
     *
     * @param string $element
     * @return string
     */
    private function _publish($element)
    {
        return $this->_refinePublish($element);
    }

    /**
     * Refine html before publish
     *
     * @param string $element
     * @return string
     */
    private function _refinePublish($element)
    {
        $html = '';
        if (! empty($this->attributes[$this->config['BEFORE']]))
            $html .= $this->attributes[$this->config['BEFORE']];

        $html .= $element;

        if (! empty($this->attributes[$this->config['AFTER']]))
            $html .= $this->attributes[$this->config['AFTER']];

        if (! empty($this->attributes[$this->config['ENCLOSE']])) {
            list ($type, $attr) = $this->_splitFirstFromArray($this->attributes[$this->config['ENCLOSE']]);
            $html = $this->tag($type, $html, $attr);
        }

        return $html;
    }

    /**
     * Adding label to element.
     * label attribute can be string or array.
     * In case of array, non-key first value will treat as $default
     *
     * @return string html
     */
    private function addLabel()
    {
        if (isset($this->attributes['label'])) {
            list ($default, $attr) = $this->_splitFirstFromArray($this->attributes[$this->config['LABEL']]);

            if (isset($this->attributes['id']) && ! in_array($this->type, [
                    'radio',
                    'checkboxList',
                ])) {
                $attr['for'] = $this->attributes['id'];
            }

            return static::_build('label', [
                $default,
                $attr,
            ]);
        }

        return null;
    }

    /**
     * Split first element from given array
     * In case of string, first=$args
     * In case of array, $first=$args[0], $args=rest of $args
     *
     * @param string|array $args
     * @return array list($first, $args)
     */
    private function _splitFirstFromArray($args)
    {
        if (is_array($args)) {
            $first = isset($args[0]) ? $args[0] : null;
            unset($args[0]);
        } else {
            $first = $args;
            $args = [];
        }

        return [
            $first,
            $args,
        ];
    }

    /**
     * Set class properties.
     *
     * @param string $type:
     *            Input type attribute
     * @param string $default:
     *            Default value attribute
     * @param array $attributes
     * @param array $options
     */
    private function setProperties($type, $default, array $attributes, array $options = [])
    {
        $this->type = $type ?: 'text';
        $this->default = $default;
        $this->attributes = $attributes;
        $this->_refineAttribute();

        $this->setOptions($options);
    }

    private function _refineAttribute()
    {
        $attributes = [];
        foreach ($this->attributes as $key => $val) {
            if (is_int($key) && ! empty($val)) {
                $key = $val;
            }
            $attributes[$key] = $val;
        }
        $this->attributes = $attributes;
    }

    /**
     * Adding type and value to $this->attributes
     * Useful for making input fields.
     * name attribute was added to keep following order: type, name, value.
     */
    private function _refineInputAttributes()
    {
        $this->attributes = array_merge([
            'type' => $this->type,
            'name' => null,
            'value' => $this->default,
        ], $this->attributes);
    }

    /**
     * Build attributes string from $this->attributes property.
     *
     * @return string: Attributes string
     */
    private function attributes()
    {
        $attributes = $this->_getRefinedAttributes();

        return $this->toString($attributes);
    }

    /**
     * Apply refinement to $this->attributes and get refined $attributes.
     *
     * @return array: $attributes
     */
    private function _getRefinedAttributes()
    {
        $attributes = $this->attributes;
        $attributes = $this->onlyNonEmpty($attributes);
        $attributes = $this->onlyString($attributes);
//        $attributes = $this->escapeAttributes($attributes);
        $attributes = $this->removeKeys($attributes, $this->config);

        return $attributes;
    }

    /**
     * Convert associative array to string.
     *
     * @param array: $attributes
     *
     * @return string: Attributes string
     */
    private function toString(array $attributes)
    {
        $string = '';

        foreach ($attributes as $key => $val) {
            if ($this->isString($val)) {
                $string .= " $key=\"$val\"";
            }
        }

        return $string;
    }

//    /**
//     * Escape attributes before display.
//     *
//     * @param array $attributes
//     * @return array
//     */
//    private function escapeAttributes(array $attributes)
//    {
//        if (! empty($attributes[$this->config['DISABLE_ESCAPE']])) {
//            return $attributes;
//        }
//
//        foreach ($attributes as $key => $value) {
//            $attributeConfig = ! empty($this->attributesConfig[$key]) ? $this->attributesConfig[$key] : [];
//            if (! empty($attributeConfig['_escape_function'])) {
//                $escapeFunction = $attributeConfig['_escape_function'];
//            }
//
//            if (! empty($escapeFunction)) {
//                $attributes[$key] = $this->escapeDeep($value, $escapeFunction);
//            }
//            unset($escapeFunction);
//        }
//
//        return $attributes;
//    }

//    /**
//     * Apply escape function to data.
//     *
//     * @param array|string $data
//     * @param string $functionName
//     * @return mixed
//     */
//    private function escapeDeep($data, $functionName)
//    {
//        if (is_array($data)) {
//            echo $data;
//            return array_map($functionName, $data);
//        } elseif (is_string($data)) {
//            return call_user_func($functionName, $data);
//        }
//
//        return $data;
//    }

    /**
     * Apply esc_attr/htmlspecialchars to both input string and array.
     *
     * @deprecated not in use since 1.1, use escapeDeep instead.
     * @param array: $attributes
     * @return mixed: htmlspecialchars filtered data
     */
    private function filter($data)
    {
        if (is_array($data)) {
            return array_map('\\esc_attr', $data);
        } elseif (is_string($data)) {
            return \esc_attr($data);
        }

        return $data;
    }

    /**
     * Add elements to array for given keys.
     *
     * @todo
     *
     * @param array $data:
     *            Given array
     * @param array $keys:
     *            Given keys to remove
     *
     * @return array
     */
    private function addKeys(array $data, array $keys, $default = '')
    {
        foreach ($keys as $key) {
            if (! isset($data[$key])) {
                $data[$key] = $default;
            }
        }

        return $data;
    }

    /**
     * Remove elements from array for given keys.
     *
     * @param array $data:
     *            Given array
     * @param array $keys:
     *            Given keys to remove
     *
     * @return array
     */
    private function removeKeys(array $data, array $keys)
    {
        foreach ($data as $key => $itm) {
            if (in_array($key, $keys)) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    /**
     * Filter all non string value from given array.
     *
     * @param array $data
     *
     * @return array
     */
    private function onlyString(array $data)
    {
        foreach ($data as $key => $itm) {
            if (! $this->isString($itm)) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    /**
     * Filter all empty value from given array.
     *
     * @param array $data
     *
     * @return array
     */
    private function onlyNonEmpty(array $data)
    {
        foreach ($data as $key => $itm) {
            if (empty($itm)) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    /**
     * Check if given argument is string.
     *
     * @param mixed $date
     *
     * @return bool
     */
    private function isString($data)
    {
        if (in_array(gettype($data), [
            'array',
            'object',
        ])) {
            return false;
        }

        return true;
    }

    /**
     * Get value for given key from an array.
     */
    private function get($key, array $data, $default = null)
    {
        if (isset($data[$key])) {
            return $data[$key];
        }

        return $default;
    }

    /**
     * Determine which method to call input()/tag()
     *
     * @param
     *            string methodName
     */
    private function _determineInputOrTag($method)
    {
        return in_array($method, $this->inputTypes) ? 'input' : 'tag';
    }

//    /**
//     * Build html element.
//     * Every _build() is creating new instance to avoid confliction.
//     *
//     * @param string $method:
//     *            Method name to call
//     * @param array $args:
//     *            Arguments array to pass to invocked method call
//     *
//     * @return string html
//     */
//    private static function _build($method, array $args)
//    {
//        $instance = new static();
//        try {
//            if (! method_exists($instance, $method)) {
//                array_unshift($args, $method);
//                $method = $instance->_determineInputOrTag($method);
//            }
//
//            return call_user_func_array([
//                $instance,
//                $method
//            ], $args);
//        } catch (\Exception $e) {
//            return 'Exception: ' . $e->getMessage() . "\n";
//        }
//    }

//    /**
//     * Call dynamic instance methods.
//     * eg: $form->text();
//     *
//     * @param string $method:
//     *            Method name to call
//     * @param array $args:
//     *            Arguments array to pass to invocked method call
//     *
//     * @return string html
//     */
//    public function __call($method, $args)
//    {
//        $html = static::_build($method, $args);
//        if ($html)
//            $this->default[] = $html;
//
//        return $html;
//    }

//    /**
//     * Call static methods.
//     * eg: FormElement::text('something');
//     *
//     * @param string $method:
//     *            Method name to call
//     * @param array $args:
//     *            Arguments array to pass to invocked method call
//     *
//     * @return string html
//     */
//    public static function __callStatic($method, $args)
//    {
//        return static::_build($method, $args);
//    }


    /**
     * Accepted config as attributes.
     *
     * @var array
     */
    protected $config = [
        'LABEL' => 'label', // hard coded on OptionsElement
        'BEFORE' => '_before',
        'AFTER' => '_after',
        'ENCLOSE' => '_enclose',
        'OPTION_BEFORE' => '_option_before', // hard coded on OptionsElement
        'OPTION_AFTER' => '_option_after', // hard coded on OptionsElement
        'DISABLE_ESCAPE' => '_disable_escape',
    ];

    /**
     * Valid html5 input type.
     * Anything other than that is considered as tag.
     *
     * @var array
     */
    protected $inputTypes = [
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
     * Attributes configurations.
     *
     * @var array
     */
    protected $attributesConfig = [
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

