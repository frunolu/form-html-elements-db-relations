<?php

declare(strict_types=1);

namespace App\HtmlElement;

class ImageElement extends HtmlElement
{
    public function __construct()
    {
        parent::__construct('img');
    }

    /**
     * @param  string $src
     * @return $this
     */
    public function setSrc(string $src): static
    {
        return $this->setAttribute('src', $src);
    }

    /**
     * Retrieves the value of the 'src' attribute.
     * If the attribute is not set, it returns an empty string.
     *
     * @return string The value of the 'src' attribute.
     */
    public function getSrc(): string
    {
        return $this->attributes['src'] ?? '';
    }





    /**
     * @var array image types to be collected and rendered into picture tag
     */
    public static $sourceTypes;

    /**
     * @var array default image types
     */
    public static $defaultSourceTypes = ['webp'];
    //public static $defaultSourceTypes = ['webp', 'jp2', 'jpx'];

    /**
     * set image types
     * @param $sourceTypes
     */
    public static function setSourceTypes($sourceTypes)
    {
        if ($sourceTypes) {
            self::$sourceTypes = $sourceTypes;
        } elseif (!self::$sourceTypes) {
            self::$sourceTypes = self::$defaultSourceTypes;
        }
    }

    /**
     * form picture element
     * @param string $src
     * @param mixed $attributes
     * @param mixed $sourceTypes
     * @return string
     */
    public static function get(string $src, $attributes = false, $sourceTypes = false)
    {
        $documentRoot = @$_SERVER['DOCUMENT_ROOT'];

        //check if the src file exists
        if (!@file_exists($documentRoot.$src)) {
            return '';
        }

        //populate properties from configuration array
        self::setSourceTypes($sourceTypes);

        $srcParts = pathinfo($src);

        //collect attributes into string
        $attributesString = '';
        if ($attributes && is_array($attributes)) {
            foreach ($attributes as $name => $value) {
                $attributesString .= ' '.$name.'="'.$value.'"';
            }
        }

        //form picture tag
        $html = '<picture>';
        foreach (self::$sourceTypes as $type) {
            $sourceSrc = str_replace('.'.$srcParts['extension'], '.'.$type, $src);
            if (file_exists($documentRoot.$sourceSrc)) {
                $html .= '<source srcset = "'.FileVersion::get($sourceSrc).'" type = "image/'.$type.'">';
            }
        }

        $html .= '<img src="'.FileVersion::get($src).'" '.$attributesString.'>'.'</picture>';

        return $html;

}}

