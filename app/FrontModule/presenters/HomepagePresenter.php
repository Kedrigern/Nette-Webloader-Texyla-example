<?php namespace FrontModule;
/** @author Ondřej Profant, 2012  */

class HomepagePresenter extends BasePresenter
{
    protected function createComponentEditForm(){
        $form = new \Nette\Application\UI\Form;
        $form->getElementPrototype()->class('ajax');
        $form->addTextarea('description_texy', 'Popis:', 100, 8)->getControlPrototype()->class("texyla span9");
        return $form;
    }
}