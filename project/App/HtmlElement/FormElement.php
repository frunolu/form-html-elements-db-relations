<?php

declare(strict_types=1);

namespace App\HtmlElement;

use Exception;



/**
 * Class FormElement
 *
 * Represents an HTML form element.
 *
 * @extends HtmlElement
 */
class FormElement extends HtmlElement
{
    /**
     * @var array $children Holds an array of children elements.
     */
    protected array $children = [];

    public function __construct()
    {
        parent::__construct('form');
    }

    /**
     * Adds an input element to the list of children.
     *
     * @param InputElement $input The input element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addInput(InputElement $input): static
    {
        $this->children[] = $input;

        return $this;
    }

    /**
     * Adds a select element to the list of children.
     *
     * @param SelectElement $select The select element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addSelect(SelectElement $select): static
    {
        $this->children[] = $select;

        return $this;
    }

    /**
     * Adds an image element to the list of children.
     *
     * @param ImageElement $image The image element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addImage(ImageElement $image): static
    {
        $this->children[] = $image;

        return $this;
    }

    /**
     * Renders the HTML representation of the element.
     *
     * @return string Returns the rendered HTML string.
     */
    public function render(): string
    {
        $attributesString = $this->renderAttributes();
        $childrenString = $this->renderChildren();

        return "<{$this->tagName}{$attributesString}>{$childrenString}</{$this->tagName}>";
    }

    /**
     * Renders the children elements as a string.
     *
     * @return string Returns the string representation of the children elements.
     */
    protected function renderChildren(): string
    {
        $childrenString = '';
        foreach ($this->children as $child) {
            $childrenString .= $child->render();
        }

        return $childrenString;
    }

    /**
     * Adds an HTML form item element to the list of children.
     *
     * @param HtmlElement $formItem The HTML form item element to be added.
     * @return $this Returns the instance of the current class.
     */
    public function addFormItem(HtmlElement $formItem): static
    {
        $this->children[] = $formItem;

        return $this;
    }

    /**
     * Sets the action attribute of the element.
     *
     * @param string $link The URL or URI to which the form data will be submitted.
     * @return $this Returns the instance of the current class.
     */
    public function setAction(string $link): static
    {
        $this->setAttribute('action', $link);

        return $this;
    }
}


/**
 * Class FormBuilder
 *
 * This class provides methods for building form elements and rendering the form.
 */
class FormBuilder
{
    /**
     * Create and render the form
     *
     * @throws Exception
     *
     * @return FormElement
     */
    public function buildForm(): FormElement
    {
        $form = $this->createView();
        $form = $this->addFormItems($form);

        echo $form->render();

        return $form;
    }

    /**
     * Add items to the form
     *
     * @param FormElement $form
     *
     * @throws Exception
     *
     * @return FormElement
     */
    private function addFormItems(FormElement $form): FormElement
    {
        $form->addFormItem($this->createInputElement('text','username','Enter your username'))
            ->addFormItem($this->createDivElement())
            ->addFormItem(
                $this->createSelectElement(
                    'gender',
                    ['male' => 'Male','female' => 'Female','other' => 'Other']
                )
            )
            ->addFormItem($this->createDivElement())
            ->addFormItem(
                $this->createInputElement('submit','submit','Submit')
            )
            ->addFormItem($this->createDivElement())
            ->addFormItem($this->createAElement('https://www.billboard.com/charts/hot-100/','music-charts'))
            ->addFormItem($this->createDivElement())
            ->addFormItem($this->createImageElement('project/www/img/musical-notes.jpg'));

        return $form;
    }

    /**
     * Create FormElement view
     *
     * @return FormElement
     */
    private function createView(): FormElement
    {
        $formElement = new FormElement();
        return $formElement->setAction('/home')->setAttribute('method', 'post');
    }

    /**
     * Create input element
     *
     * @param string $type
     * @param string $name
     * @param string $placeholder
     *
     * @return InputElement
     */
    private function createInputElement(string $type, string $name, string $placeholder): InputElement
    {
        $inputElement = new InputElement();

        return $inputElement->buildInputElement($type, $name, $placeholder);
    }

    /**
     * @param string $name
     * @param array  $options
     *
     * @return SelectElement
     */
    private function createSelectElement(string $name, array $options): SelectElement
    {
        $selectElement = new SelectElement();

        return $selectElement->buildSelectElement($name, $options);
    }

    /**
     * Create div element
     *
     * @return DivElement
     */
    private function createDivElement(): DivElement
    {
        return new DivElement();
    }

    /**
     * Create anchor element
     *
     * @param string $href
     * @param string $text
     *
     * @return AElement
     */
    private function createAElement(string $href, string $text): AElement
    {
        $aElement = new AElement();
        return $aElement->buildAElement($href, $text);
    }

    /**
     * Create image element
     *
     * @param string $src
     *
     * @throws Exception
     *
     * @return ImageElement
     */
    private function createImageElement(string $src): ImageElement
    {
        $imageElement = new ImageElement();
        $imageElement->setSrc($src);

        if ($imageElement->getSrc() !== $src) {
            throw new Exception('The image source has not been set properly.');
        }

        return $imageElement;
    }
}

