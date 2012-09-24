<?php

namespace FrontModule;

use Nette\Application\UI\Form;

class HomepagePresenter extends BasePresenter
{
    protected function createComponentEditForm(){
        $form = new \Nette\Application\UI\Form;
        $form->getElementPrototype()->class('ajax');
        $form->addTextarea('description_texy', 'Popis:', 100, 8)->getControlPrototype()->class("texyla");         
        return $form;
    }
}

