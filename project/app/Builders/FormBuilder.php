<?php

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
     * @return FormElement
     * @throws Exception
     */
    public function buildForm(): FormElement
    {
        $form = $this->createView();
        $form = $this->addFormItems($form);
        echo $form->render();
        return $form;
    }

    /**
     * @param  FormElement $form
     * @return FormElement
     * @throws Exception
     */
    private function addFormItems(FormElement $form): FormElement
    {
        $form->addFormItem($this->createInputElement('text', 'username', 'Enter your username'))
            ->addFormItem($this->createDivElement())
            ->addFormItem(
                $this->createSelectElement('gender', ['male' => 'Male', 'female' => 'Female', 'other' => 'Other'])
            )

            ->addFormItem($this->createDivElement())
            ->addFormItem($this->createInputElement('submit', 'submit', 'Submit'))
            ->addFormItem($this->createDivElement())
            ->addFormItem($this->createAElement('https://www.billboard.com/charts/hot-100/', 'music-charts'))
            ->addFormItem($this->createDivElement())
            ->addFormItem($this->createImageElement('project/www/img/musical-notes.jpg'));

        return $form;
    }

    /**
     * @return FormElement
     */
    private function createView(): FormElement
    {
        return (new FormElement())->setAction('/home')->setAttribute('method', 'post');
    }

    /**
     * @param  string $type
     * @param  string $name
     * @param  string $placeholder
     * @return InputElement
     */
    private function createInputElement(string $type, string $name, string $placeholder): InputElement
    {
        return (new InputElement())->buildInputElement($type, $name, $placeholder);
    }

    /**
     * @param  string $name
     * @param  array  $options
     * @return SelectElement
     */
    private function createSelectElement(string $name, array $options): SelectElement
    {
        return (new SelectElement())->buildSelectElement($name, $options);
    }

    /**
     * @return DivElement
     */
    private function createDivElement(): DivElement
    {
        return new DivElement();
    }

    /**
     * @param  string $href
     * @param  string $text
     * @return AElement
     */
    private function createAElement(string $href, string $text): AElement
    {
        return (new AElement())->buildAElement($href, $text);
    }

    /**
     * @param  string $src
     * @return ImageElement
     * @throws Exception
     */
    private function createImageElement(string $src): ImageElement
    {
        $imageElement = (new ImageElement())->setSrc($src);

        if ($imageElement->getSrc() !== $src) {
            throw new Exception('The image source has not been set properly.');
        }

        return $imageElement;
    }
}
