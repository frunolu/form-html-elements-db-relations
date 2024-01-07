<?php

declare(strict_types=1);

namespace App\HtmlElement;

class ImageElement extends HtmlElement
{

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
    public static function setSourceTypes($sourceTypes): void
    {
        if ($sourceTypes) {
            self::$sourceTypes = $sourceTypes;
        } elseif (!self::$sourceTypes) {
            self::$sourceTypes = self::$defaultSourceTypes;
        }
    }

    /**
     * form picture element
     * @param $src
     * @param $data
     * @param $default
     * @return string
     */
    public function get($src, $data = false,$default = false): string
    {
        $documentRoot = @$_SERVER['DOCUMENT_ROOT'];


        //check if the src file exists
        if (!@file_exists($documentRoot . $src)) {
            return '';
        }

        //populate properties from configuration array
        self::setSourceTypes($default);

        $srcParts = pathinfo($src);

        //collect attributes into string
        $attributesString = '';
        if ($data && is_array($data)) {
            foreach ($data as $name => $value) {
                $attributesString .= ' ' . $name . '="' . $value . '"';
            }
        }

        //form picture tag
        $html = '<picture>';
        foreach (self::$sourceTypes as $type) {
            $sourceSrc = str_replace('.' . $srcParts['extension'], '.' . $type, $src);
            if (file_exists($documentRoot . $sourceSrc)) {
                $html .= '<source srcset = "' .self::getFileVersion($sourceSrc). '" type = "image/' . $type . '">';
            }
        }

        $html .= '<img src="' .self::getFileVersion($src). '" ' . $attributesString . '>' . '</picture>';

        return $html;
    }

    /**
     * Adds timestamp of the latest file modification.
     * This could be used to automatically reset cached version of files in browser (css, js, ...) after file updated
     *
     * @param string $filePath relative path from to the file
     * @return string
     */
    public static function getFileVersion($filePath)
    {
        //get absolute file path
        $fileAbsPath = @$_SERVER['DOCUMENT_ROOT'] . $filePath;

        //add datetime parameter
        if (file_exists($fileAbsPath)) {
            $filePath .= ((strpos($filePath, '?')) ? '&' : '?') . 'v=' . filemtime($fileAbsPath);
        }

        return $filePath;
    }
}
