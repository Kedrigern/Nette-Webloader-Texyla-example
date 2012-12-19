<?php namespace FrontModule;
/** @author Ondřej Profant, 2012 */
use Kdyby\Extension\Forms\BootstrapRenderer\BootstrapRenderer,
    Nette\Forms\Container;

class FormPresenter extends BasePresenter
{
    protected function createComponentMyForm()
    {
        $form = new \MyForms\MyForm();
        $form->onSuccess[] = callback($this, 'formSubmited');
        $form->setRenderer(new BootstrapRenderer);
        return $form;
    }

    protected  function createComponentForm2()
    {

    }

    public function formSubmited(\MyForms\MyForm $form)
    {
        print_r( $form->getValues( true ) );
        die('');
    }
}