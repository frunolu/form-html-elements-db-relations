<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\HtmlElement\FormElement;
use App\Builders\FormBuilder;
use Nette;
use Nette\Application\UI\Form as NetteForm;

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

    private function buildForm(): FormElement
    {
        return $this->formBuilder->buildForm();
    }

    protected function createComponentMyForm(): NetteForm
    {
        $formElement = $this->buildForm();
        $form = new NetteForm;
        $form->setAction($this->link('submit'));

        return $form;
    }

    public function renderDefault(): void
    {
        $this->template->myForm = $this['myForm'];
    }
}
