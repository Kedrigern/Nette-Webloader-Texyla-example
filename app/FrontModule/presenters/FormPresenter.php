<?php namespace FrontModule;
/** @author Ondřej Profant, 2012 */
use Kdyby\Extension\Forms\BootstrapRenderer\BootstrapRenderer;

class FormPresenter extends BasePresenter
{
    protected function createComponentMyForm()
    {
        $form = new \MyForms\MyForm();
        $form->onSuccess[] = callback($this, 'formSubmited');
        $form->setRenderer(new BootstrapRenderer);
        return $form;
    }

    public function formSubmited(\MyForms\MyForm $form)
    {
        $values = $form->getValues(true);
        if( $values['address']['optional'] ) {
            $values['address'] = null;
        } else {
            unset($values['address']['optional']);
        }
        print_r($values);
        die;
        $this->flashMessage("Result: " . implode(', ', $values), 'success' );
    }
}