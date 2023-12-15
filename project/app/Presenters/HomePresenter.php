<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\HtmlElement\FormElement;
use App\Builders\FormBuilder;
use Exception;
use Nette;
use Nette\Application\UI\Form as NetteForm;
use Nette\Application\UI\InvalidLinkException;

class HomePresenter extends Nette\Application\UI\Presenter
{
    /**
     * @var FormBuilder
     */
    private FormBuilder $formBuilder;

    /**
     * HomePresenter constructor.
     *
     * @param FormBuilder $formBuilder
     */
    public function __construct(FormBuilder $formBuilder)
    {
        parent::__construct();
        $this->formBuilder = $formBuilder;
    }

    /**
     * Builds and returns a FormElement object using the assigned FormBuilder.
     *
     * @return FormElement The built FormElement object.
     * @throws Exception
     */
    private function buildForm(): FormElement
    {
        return $this->formBuilder->buildForm();
    }

    /**
     * Creates and returns an instance of the NetteForm class for the MyForm component.
     *
     * @return NetteForm The created instance of the NetteForm class.
     * @throws InvalidLinkException
     */
    protected function createComponentMyForm(): NetteForm
    {
        $formElement = $this->buildForm();
        $form = new NetteForm;
        $form->setAction($this->link('submit'));

        return $form;
    }

    /**
     * Renders the default view of the presenter.
     *
     */
    public function renderDefault(): void
    {
        $this->template->myForm = $this['myForm'];
    }
}
