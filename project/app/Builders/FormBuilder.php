<?php

declare(strict_types=1);

namespace App\Builders;

use App\Model\HtmlElement\AElement;
use App\Model\HtmlElement\DivElement;
use App\Model\HtmlElement\FormElement;
use App\Model\HtmlElement\ImageElement;
use App\Model\HtmlElement\InputElement;
use App\Model\HtmlElement\SelectElement;
use Exception;

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
